<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Center;
use App\Models\Renter;
use App\Models\Maincenter;
use App\Models\Nationality;
use App\Models\Employee;
use App\Models\Payment_type;
use App\Models\Unit;
use App\Models\Unit_type;
use App\Models\All_file;
use App\Models\Contract;
use App\Models\Othercontent;
use App\Models\Payment;
use App\Models\Sarf;
use App\Models\Id_type;
use App\Models\Location;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
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
use AliAbdalla\Tafqeet\Core\Tafqeet;
use Illuminate\Contracts\Database\Eloquent\Builder;


class RenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(Request $request): View
    {

        $data = Renter::with('contracts.unit.unitType','contracts.center')->get();

     //dd($data[9]->contracts) ;
        $current_user = User::find(Auth::user()->id) ;
        return view('renters.index',compact('data','current_user'))
            ->with('i', 0);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {

        $current_user = User::find(Auth::user()->id) ;
        $id_types = Id_type::all();
        $nationalities = Nationality::get();

        return view('renters.create',compact('current_user','id_types','nationalities'));
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
        if($request->has('file'))
        {
            $uploadedFile = $request->file('file');
            $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
            $img = $uploadedFile->storeAs('uploads', $storedName, 'public');
        }
        $work_letter = '';
        if($request->has('work_letter'))
        {
            $uploadedFile = $request->file('work_letter');
            $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
            $work_letter = $uploadedFile->storeAs('uploads', $storedName, 'public');
        }

        $this->validate($request, [
            'name' => 'required',
         //   'id_no' => 'required',
            'nationality' => 'required',
            'mobile_no' => ['required', 'regex:/^05\d{8}$/'],

        ], [
            'name' => 'يجب تسجيل الاسم',
         //   'id_no' => 'required',
            'nationality' => 'يجب اختيار الجنسية',
            'mobile_no' => 'يجب كتابة رقم الجوال بطريقة صحيحة '

        ]);

        $input = $request->all();
        $input['img']= $img ;
        $input['work_letter']= $work_letter ;

        $input['created_by']= Auth::user()->id ;
      // dd($input) ;
        $renter =  Renter::create($input);

        if ($renter && $request->filled('contact_name')) {

            $contacts = [];

            foreach ($request->contact_name as $index => $name) {

                // تجاهل السطور الفارغة
                if (empty($name) || empty($request->contact_no[$index])) {
                    continue;
                }

                $contacts[] = [
                    'name' => $name,
                    'mobile_no'   => $request->contact_no[$index],
                ];
            }



            // حفظ جماعي عبر العلاقة
            $renter->contacts()->createMany($contacts);
        }



        return redirect()->route('renters.index')
                        ->with('success','     تم الاضافة  بنجاح');
    }

     public function check_contract_dates($start_date, $end_date, $unit_id)
    {

        $sql = "SELECT count(*) c FROM `contracts` WHERE
         unit_id = " . $unit_id . " and
                    (start_date BETWEEN '" . $start_date . "' and '" . $end_date . "'
                   or end_date BETWEEN '" . $start_date . "' and '" . $end_date . "' )     ";
        $res = DB::select($sql)[0];
        if ($res->c > 0)
            return false;
        else
            return true;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $renter = Renter::with('contracts.payments')->find($id);
        $contracts = Contract::with('renter','payments.contract.renter','payments.paymentType','payments.employee')->where('renter_id', $id)->orderByDesc('id')->get();

     if ($request->has('btn_add_contract')) {

            $this->validate($request, [
                'start_date' => 'required',
                'end_date' => 'required',

                'no_of_payments' => 'required',
                'year_amount' => 'required',
                'renter_id' => 'required',
                'unit_id' => 'required',
                'maincenter_id' => 'required',
                'center_id' => 'required'
            ], [
                'start_date' => 'يجب اختيار بداية العقد',
                'end_date' => 'يجب اختيار نهاية العقد',

                'no_of_payments' => 'يجب تسجيل عدد الدفعات بالسنة ',
                'year_amount' => 'يجب اختيار قيمة الايجار بالسنة',
                'renter_id' => 'يجب اختيار المستأجر',
                'unit_id' => 'يجب اختيار الوحدة (الشقه او المحل) ',
                'maincenter_id' => 'يجب اختيار المركز الرئيسي',
                'center_id' => 'يجب اختيار العمارة'
            ]);

            $input = $request->all();

            $input['created_by'] = Auth::user()->id;

            $start_date = $request->start_date;
            $end_date = $request->end_date;

            $date1 = date_create($start_date);
            $date2 = date_create($end_date);

            $no_of_all_days = date_diff($date1, $date2)->format('%a');
            if ($this->check_contract_dates($request->start_date, $request->end_date, $request->unit_id)) {
                if ($contract =  Contract::create($input)) {

                    // add Notification
                    $toUsers = User::where('is_admin', 1)->get();
                    foreach ($toUsers as $user) {
                        $n_date['user_id'] = $user->id;
                        $n_date['message'] = "تم تحرير عقد جديد ";
                        $n_date['url'] = "contracts.show";
                        $n_date['element_id'] = $contract->id;
                        Notification::create($n_date);
                    }


                    // SELECT DATEDIFF('2025/08/31', '2024/08/30');


                    $no_of_section_days = (int) floor($no_of_all_days / $request->no_of_payments);
                    $payment_data['contract_id'] = $contract->id;
                    $payment_data['status'] = 0;
                    $payment_data['maincenter_id'] = $request->maincenter_id;
                    $payment_data['center_id'] = $request->center_id;
                    $payment_data['unit_id'] = $request->unit_id;
                    $payment_data['created_by'] = Auth::user()->id;
                    $payment_data['p_date'] = $start_date;
                    $payment_data['p_dateh'] =  Hijri::ShortDate($start_date);
                    if ($request->insurance_amount > 0) {
                        $payment_data['amount'] = $request->insurance_amount;
                        $payment_data['payment_no'] = 0;
                        $payment_data['notes'] = 'مبلغ التأمين';
                        Payment::create($payment_data);
                    }
                    if ($request->services_amount > 0) {
                        $payment_data['amount'] = $request->services_amount;
                        $payment_data['payment_no'] = 0;
                        $payment_data['notes'] = ' الخدمات  ';
                        Payment::create($payment_data);
                    }

                    $payment_data['notes'] = '';
                    $payment_data['amount'] = $request->year_amount / $request->no_of_payments;
                    for ($i = 0; $i < $request->no_of_payments; $i++) {
                        $payment_data['payment_no'] = $i + 1;
                        Payment::create($payment_data);
                        $payment_data['p_date'] = (new Carbon($payment_data['p_date']))->addDays($no_of_section_days)->format('Y/m/d');
                        $payment_data['p_dateh'] =  Hijri::ShortDate($payment_data['p_date']);
                    }
                     return redirect()->route('renters.show' , $id)->with('success', '     تم    بنجاح');
                }
            } else {
                return redirect()->back()->with('danger', 'يوجد تعارض في تاريخ العقد مع عقد أخر');

            }
        }
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
                        $payment2->updated_at =  Carbon::now();

                        $payment2->save();
                    } else // insert
                    {

                        $payment2 = $payment->replicate();
                        $payment2->amount = $payment->remender_amount;
                        $payment2->created_by = Auth::user()->id;
                        $payment2->created_at =  Carbon::now();
                        $payment2->save();
                    }
                }

                $payment->amount_txt =    Tafqeet::arablic($request->amount);
                $payment->status =   1;

                $payment->year_m = substr($request->actual_date, 2, 2);

                   $payment->year_h = substr($request->actual_dateh, 2, 2);
                $sql = "SELECT nvl(max(sereal),0)+1 as sereal from payments where year_m = '" . $payment->year_m . "'";

                $res = DB::select($sql)[0];
                $payment->sereal = $res->sereal;
                $payment->notes =  $request->notes;
                $payment->emp_id = $request->emp_id;
                $payment->payment_type = $request->payment_type;
                $payment->actual_dateh = $request->actual_dateh;
                $payment->actual_date = $request->actual_date;
                $payment->updated_by = Auth::user()->id;
                $payment->updated_at =  Carbon::now();


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
                     return redirect()->route('renters.show' , $id)->with('success', '     تم    بنجاح');
                }
            }
        }



        $payments=array() ;

         foreach($contracts as $c)
         {
            $payments[]=$c->payments ;
         }
         $current_user = User::find(Auth::user()->id) ;
           $emps = Employee::all();
        $payment_types = Payment_type::all();
         $id_types = Id_type::all();

           $files = All_file::where('object_name', 'renters')
            ->where('object_id', $id)
            ->get();

             $maincenters = Maincenter::get();
        return view('renters.show',compact('renter','files','maincenters','id_types','contracts','payments','current_user','emps','payment_types'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $renter = Renter::find($id);
        $current_user = User::find(Auth::user()->id) ;
          $id_types = Id_type::all();
       $nationalities = Nationality::get();
        return view('renters.edit',compact( 'renter','id_types','nationalities','current_user'));


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
            'name' => 'required',
         //   'id_no' => 'required',
            'nationality' => 'required',
         //   'mobile_no' => 'required'

        ], [
            'name' => 'يجب تسجيل الاسم',
         //   'id_no' => 'required',
            'nationality' => 'يجب اختيار الجنسية',
         //   'mobile_no' => 'required'

        ]);

        $input = $request->all();
        if($request->has('file'))
        {
            $uploadedFile = $request->file('file');
            $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
            $img = $uploadedFile->storeAs('uploads', $storedName, 'public');
            $input['img']= $img ;
        }
         if($request->has('work_letter'))
        {
            $uploadedFile = $request->file('work_letter');
            $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
            $work_letter = $uploadedFile->storeAs('uploads', $storedName, 'public');
              $input['work_letter']= $work_letter ;
        }

        $input['updated_by']= Auth::user()->id ;
      // dd($input) ;
        $renter =  Renter::find($id);


        $renter->update($input);


        return redirect()->route('renters.index')
                        ->with('success','تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        Renter::find($id)->delete();
        return redirect()->route('renters.index')
                        ->with('success','تم الحذف بنجاح');
    }
}
