<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Center;
use App\Models\Renter;
use App\Models\Employee;
use App\Models\Payment_type;
use App\Models\Unit;
use App\Models\Maincenter;
use App\Models\Unit_type;
use App\Models\Contract;
use App\Models\Payment;
use App\Models\Location;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Alkoumi\LaravelHijriDate\Hijri;
use Illuminate\Support\Carbon;
use App\Models\Notification;
// use Alkoumi\LaravelArabicTafqeet\Tafqeet;
use AliAbdalla\Tafqeet\Core\Tafqeet;
use Illuminate\Contracts\Database\Eloquent\Builder;







class PaymentController extends Controller
{

   public function __construct()
    {
        $this->middleware('auth');

    }

    function formatPaymentDiff($date)
    {
        $today = Carbon::today();
        $target = Carbon::parse($date);

        $diffDays = $today->diffInDays($target, false); // false = يسمح بالسالب

        if ($diffDays === 0) {
            return 'اليوم';
        }

        $prefix = $diffDays > 0 ? 'باقي' : 'فات عليه';
        $days = abs($diffDays);

        if ($days < 7) {
            return "$prefix $days يوم";
        }

        if ($days < 30) {
            $weeks = floor($days / 7);
            return "$prefix $weeks أسبوع";
        }

        $months = floor($days / 30);
        return "$prefix $months شهر";
    }

    function send_late_payments()
    {

        $today = Carbon::today();
        $afterSevenDays = Carbon::today()->addDays(7);

        $payments_un_payed = Payment::with([
            'contract.renter',
            'contract.unit',
            'unit',
            'center',
            'maincenter',
            'contract.center',
            'paymentType',
            'employee'
        ])
            ->where('status', 0)
            ->whereDate('p_date', '<=', $afterSevenDays) // مضى أو خلال 7 أيام قادمة
            ->orderBy('p_date')
            ->get();


        //======================================================
        if ($payments_un_payed->isEmpty()) {
            $message = '<p style="color:green;text-align:center">لا توجد دفعات مستحقة حالياً</p>';
        }
        else
        {
            $message = '
<h2 style="text-align:center">قائمة الدفعات التي حان موعدها</h2>

<table width="100%" border="1" cellpadding="6" cellspacing="0" dir="rtl" style="border-collapse:collapse;font-size:14px">
    <thead style="background:#f2f2f2">
        <tr>
         <th>الدفعة</th>
            <th>المستأجر</th>
             <th>المركز الرئيسي</th>
            <th>العمارة</th>
            <th>رقم الوحدة</th>
            <th>الجوال</th>
            <th>موعد الدفع</th>
            <th>الفترة المتبقية</th>
            <th>المبلغ</th>

        </tr>
    </thead>
    <tbody>
';
            $bg = '#cccccc';
            foreach ($payments_un_payed as $row) {

                $days = dateDiff(today(), $row->p_date);

                if ($bg == '#cccccc')
                    $bg = '#ffffff';
                else
                    $bg = '#cccccc';


                $paymentNo = $row->payment_no == 0 ? $row->notes : $row->payment_no;

                $message .= '
        <tr style="background-color:'.$bg.'">
         <td>'.$paymentNo.'</td>
            <td>'.($row->contract->renter->name ?? '').'</td>
             <td>'.($row->maincenter->name ?? '').'</td>


            <td>'.($row->center->center_name ?? '').'</td>
            <td>'.($row->unit->unit_no ?? '').'</td>
             <td>'.($row->contract->renter->mobile_no ?? '').'</td>
            <td>'.$row->p_date.' م - '.$row->p_dateh.' هـ</td>
            <td style="text-align:center">'.$this->formatPaymentDiff($row->p_date).'</td>
            <td>'.$row->amount.'</td>

        </tr>
    ';
            }

            $message .= '
    </tbody>
</table>
';
        }
        $to = ['fathylogic@gmail.com', 'im-wael@hotmail.com'] ;
        send_mail(
            $to,
            'تنبيه الدفعات المستحقة',
            $message,
            true // HTML
        ) ;

    }
    public function get_late_payments(Request $request)
    {

        if ($request->has('btn_savePayment')) {


            $payment = Payment::find($request->payment_id);
            if ($request->amount > 0) {
                $payment->amount = $request->amount;

                $payment->remender_amount = $request->true_amount - $request->amount;
                if ($payment->remender_amount > 0) {
                    // add to next payment
                    $sql = "SELECT id FROM `payments` WHERE contract_id = $payment->contract_id and status = 0  and id > $payment->id  LIMIT 1 ";
                    $res = DB::select($sql);
                    if (count($res) > 0) // update
                    {
                        $payment2 = Payment::find($res[0]->id);
                        $payment2->amount = $payment2->amount + $payment->remender_amount;
                        $payment2->updated_by = Auth::user()->id;
                        $payment2->updated_at = Carbon::now();

                        $payment2->save();
                    } else // insert
                    {

                        $payment2 = $payment->replicate();
                        $payment2->amount = $payment->remender_amount;
                        $payment2->created_by = Auth::user()->id;
                        $payment2->created_at = Carbon::now();
                        $payment2->save();
                    }
                }

                $payment->amount_txt = Tafqeet::arablic($request->amount);
                $payment->status = 1;

                $payment->year_m = substr($request->actual_date, 2, 2);

                $payment->year_h = substr($request->actual_dateh, 2, 2);
                $sql = "SELECT nvl(max(sereal),0)+1 as sereal from payments where year_m = '" . $payment->year_m . "'";

                $res = DB::select($sql)[0];
                $payment->sereal = $res->sereal;
                $payment->notes = $request->notes;
                $payment->emp_id = $request->emp_id;
                $payment->payment_type = $request->payment_type;
                $payment->actual_dateh = $request->actual_dateh;
                $payment->actual_date = $request->actual_date;
                $payment->updated_by = Auth::user()->id;
                $payment->updated_at = Carbon::now();


                $payment->payment_type = $request->payment_type;


                if ($payment->save()) {


                    $toUsers = User::where('is_admin', 1)->get();
                    foreach ($toUsers as $user) {
                        $n_date['user_id'] = $user->id;
                        $n_date['message'] = "تم استلام مبلغ نقدي";
                        $n_date['url'] = "payments.show";
                        $n_date['element_id'] = $payment->id;
                        Notification::create($n_date);
                    }
                    return redirect()->route('payments.index')->with('success', '     تم    بنجاح');
                }
            }
        }



        $today = Carbon::today();
        $afterSevenDays = Carbon::today()->addDays(7);

        $payments_un_payed = Payment::with([
            'contract.renter',
            'contract.unit',
            'unit',
            'center',
            'maincenter',
            'contract.center',
            'paymentType',
            'employee'
        ])
            ->where('status', 0)
            ->whereDate('p_date', '<=', $afterSevenDays) // مضى أو خلال 7 أيام قادمة
            ->orderBy('p_date')
            ->get();

        $renters = Renter::all();
        $centers = Center::all();
        $emps = Employee::all();
        $payment_types = Payment_type::all();




        $current_user = User::find(Auth::user()->id);

        //dd($message) ;
        return view('payments.get_late_payments', compact('payments_un_payed','renters','centers','emps','payment_types', 'current_user'))
            ->with('i', 0);
    }

     public function print($id)
    {
        $row = Payment::with('contract.renter')->find($id);
        if ($row) {
            $ser = '(' . str_pad($row['sereal'], 4, '0', STR_PAD_LEFT) . ')' . $row['year_m'] . '-' . $row['year_h'];
            $pdateh = 'التاريخ:' . $row['actual_dateh'] . 'هـ';
            $pdate = 'Date:' . $row['actual_date'];
           //  if ($row['payment_no'] == 0)
                $p_note = $row['notes'];
          //  else
              //   $p_note = ':دفعة رقم' . $row['payment_no'] . ' من الايجار السنوي';

            $p_note .= '   رقم العقد الالكتروني  :  ' . $row['contract']['e_no'];

           // dd($row) ;
            return view('payments.print', compact('row', 'ser', 'pdateh', 'pdate', 'p_note' ));
        } else {
            return redirect()->back()->with('danger', 'لا يوجد بيانات مطابقة');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $amount = 7587;
        $arablic = Tafqeet::arablic($amount);

        if ($request->has('btn_savePayment')) {


            $payment = Payment::find($request->payment_id);
            if ($request->amount > 0) {
                $payment->amount = $request->amount;

                $payment->remender_amount = $request->true_amount - $request->amount;
                if ($payment->remender_amount > 0) {
                    // add to next payment
                    $sql = "SELECT id FROM `payments` WHERE contract_id = $payment->contract_id and status = 0  and id > $payment->id  LIMIT 1 ";
                    $res = DB::select($sql);
                    if (count($res) > 0) // update
                    {
                        $payment2 = Payment::find($res[0]->id);
                        $payment2->amount = $payment2->amount + $payment->remender_amount;
                        $payment2->updated_by = Auth::user()->id;
                        $payment2->updated_at = Carbon::now();

                        $payment2->save();
                    } else // insert
                    {

                        $payment2 = $payment->replicate();
                        $payment2->amount = $payment->remender_amount;
                        $payment2->created_by = Auth::user()->id;
                        $payment2->created_at = Carbon::now();
                        $payment2->save();
                    }
                }

                $payment->amount_txt = Tafqeet::arablic($request->amount);
                $payment->status = 1;

                $payment->year_m = substr($request->actual_date, 2, 2);

                $payment->year_h = substr($request->actual_dateh, 2, 2);
                $sql = "SELECT nvl(max(sereal),0)+1 as sereal from payments where year_m = '" . $payment->year_m . "'";

                $res = DB::select($sql)[0];
                $payment->sereal = $res->sereal;
                $payment->notes = $request->notes;
                $payment->receved_by = $request->receved_by;
                $payment->emp_id = $request->emp_id;
                $payment->payment_type = $request->payment_type;
                $payment->actual_dateh = $request->actual_dateh;
                $payment->actual_date = $request->actual_date;
                $payment->updated_by = Auth::user()->id;
                $payment->updated_at = Carbon::now();


                $payment->payment_type = $request->payment_type;


                if ($payment->save()) {


                    $toUsers = User::where('is_admin', 1)->get();
                    foreach ($toUsers as $user) {
                        $n_date['user_id'] = $user->id;
                        $n_date['message'] = "تم استلام مبلغ نقدي";
                        $n_date['url'] = "payments.show";
                        $n_date['element_id'] = $payment->id;
                        Notification::create($n_date);
                    }
                    return redirect()->route('payments.index')->with('success', '     تم    بنجاح');
                }
            }
        }



            $payments_payed = Payment::with(['contract.renter','contract.unit','unit','center','maincenter','contract.center', 'paymentType', 'employee'])
                    ->where('status',1)
                    ->orderByDesc('id')
                     ->get();
            $payments_un_payed = Payment::with(['contract.renter','contract.unit','unit','center','maincenter','contract.center', 'paymentType', 'employee'])
                    ->where('status',0)
                    ->orderBy('p_date')
                     ->get();

        // dd( $data) ;

        $renters = Renter::all();
        $centers = Center::all();
        $emps = Employee::all();
        $payment_types = Payment_type::all();




        $current_user = User::find(Auth::user()->id);
        return view('payments.index', compact('payments_payed','payments_un_payed','renters','centers','emps','payment_types', 'current_user'))
             ->with('i', 0);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {

        $current_user = User::find(Auth::user()->id);
        $centers = Center::get();
        $types = Unit_type::get();
        $renters = Renter::get();
        return view('payments.create', compact('current_user', 'centers', 'types', 'renters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {

        $img = '';
        if ($request->has('file')) {
            $uploadedFile = $request->file('file');
            $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
            $img = $uploadedFile->storeAs('uploads', $storedName, 'public');
        }

        $this->validate($request, [
            'unit_description' => 'required',
            'unit_type' => 'required',
            'center_id' => 'required',
            'electric_no' => 'required'
        ]);

        $input = $request->all();
        $input['img'] = $img;
        $input['created_by'] = Auth::user()->id;
        // dd($input) ;
        $unit =  Unit::create($input);


        return redirect()->route('payments.index')
            ->with('success', '     تم الاضافة  بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function check_contract_dates($start_date, $end_date)
    {

        $sql = "SELECT count(*) c FROM `contracts` WHERE
                    start_date BETWEEN '" . $start_date . "' and '" . $end_date . "'
                   or end_date BETWEEN '" . $start_date . "' and '" . $end_date . "' ";
        $res = DB::select($sql)[0];
        if ($res->c > 0)
            return false;
        else
            return true;
    }

    public function show($id, Request $request)
    {
        // Request $request

         $payment = Payment::with(['contract.renter','contract.unit','contract.center', 'paymentType', 'employee'])
                    ->find($id);
        //dd($payment) ;


        $current_user = User::find(Auth::user()->id);
        return view('payments.show', compact('payment', 'current_user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $unit = Unit::find($id);
        $current_user = User::find(Auth::user()->id);
        $centers = Center::get();
        $types = Unit_type::get();
        $renters = Renter::get();

        return view('payments.edit', compact('unit', 'current_user', 'centers', 'types', 'renters'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {

        $this->validate($request, [
            'unit_description' => 'required',
            'unit_type' => 'required',
            'center_id' => 'required',
            'electric_no' => 'required'
        ]);

        $input = $request->all();
        if ($request->has('file')) {
            $uploadedFile = $request->file('file');
            $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
            $img = $uploadedFile->storeAs('uploads', $storedName, 'public');
            $input['img'] = $img;
        }

        $input['updated_by'] = Auth::user()->id;
        // dd($input) ;
        $unit =  Unit::find($id);


        $unit->update($input);


        return redirect()->route('payments.index')
            ->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        Unit::find($id)->delete();
        return redirect()->route('payments.index')
            ->with('success', 'تم الحذف بنجاح');
    }
}
