<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employee;
use App\Models\Center;
use App\Models\Ohda;
use App\Models\Location;
use App\Models\Unit;
use App\Models\All_file;
use App\Models\Payment_type;
use App\Models\Source_type;
use App\Models\Sarf_type;
use App\Models\Service_type;
use App\Models\Recipient;
use App\Models\Payroll;
use App\Models\Othercontent;
use App\Models\Unit_type;
use App\Models\Contract;
use App\Models\Payment;
use App\Models\Renter;
use App\Models\Sarf;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


use App\Models\Maincenter;
use App\Models\Nationality;

use App\Models\Id_type;

use Alkoumi\LaravelHijriDate\Hijri;
use Illuminate\Support\Carbon;
use App\Models\Notification;
use AliAbdalla\Tafqeet\Core\Tafqeet;
use Illuminate\Contracts\Database\Eloquent\Builder;



class CenterController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {

        $data = Center::with('location')->get();

        $current_user = User::find(Auth::user()->id);
        return view('centers.index', compact('data', 'current_user'))
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
        $locations = Location::get();
        $others = Othercontent::get();
        return view('centers.create', compact('locations', 'others', 'current_user'));
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
            'center_name' => 'required',
            'center_location' => 'required',
            //  'woter_no' => 'required',
            // 'electric_no' => 'required',
            'maincenter_id'   =>  'required'
        ], [
            'center_name' => 'يجب ادخال اسم العمارة',
            'center_location' => 'يجب اختيار الموقع',
            'maincenter_id'   =>  'يجب اختيار المركز الرئيسي '

            //  'woter_no' => 'required',
            //  'electric_no' => 'required'
        ]);

        $input = $request->all();
        $input['img'] = $img;
        $input['created_by'] = Auth::user()->id;
        if (isset($request->othercontents)) {
            $input['othercontents'] = implode(",", $request->othercontents);
        }
        $center =  Center::create($input);

        return redirect()->route('centers.show', $center->maincenter_id)
            ->with('success', '     تم الاضافة  بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function check_contract_dates($start_date, $end_date, $center_id)
    {

        $sql = "SELECT count(*) c FROM `contracts` WHERE
        ( unit_id =  0  or unit_id is null) and center_id = " . $center_id . " and
                    (start_date BETWEEN '" . $start_date . "' and '" . $end_date . "'
                   or end_date BETWEEN '" . $start_date . "' and '" . $end_date . "' )     ";
        $res = DB::select($sql)[0];
        if ($res->c > 0)
            return false;
        else
            return true;
    }
    public function show($id, Request $request)
    {
        $center = Center::with('maincenter', 'location')->find($id);
        $current_user = User::find(Auth::user()->id);


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
                     return redirect()->route('centers.show' , $id)->with('success', '     تم    بنجاح');
                }
            }
        }


        if ($request->has('btn_add_contract')) {

            $this->validate($request, [
                'start_date' => 'required',
                'end_date' => 'required',

                'no_of_payments' => 'required',
                'year_amount' => 'required',
                'renter_id' => 'required',

                'maincenter_id' => 'required',
                'center_id' => 'required'
            ], [
                'start_date' => 'يجب اختيار بداية العقد',
                'end_date' => 'يجب اختيار نهاية العقد',

                'no_of_payments' => 'يجب تسجيل عدد الدفعات بالسنة ',
                'year_amount' => 'يجب اختيار قيمة الايجار بالسنة',
                'renter_id' => 'يجب اختيار المستأجر',

                'center_id' => 'يجب اختيار العمارة'
            ]);

            $input = $request->all();

            $input['created_by'] = Auth::user()->id;

            $start_date = $request->start_date;
            $end_date = $request->end_date;

            $date1 = date_create($start_date);
            $date2 = date_create($end_date);

            $no_of_all_days = date_diff($date1, $date2)->format('%a');
            if ($this->check_contract_dates($request->start_date, $request->end_date, $id)) {
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
                    $payment_data['center_id'] = $id;
                    $payment_data['unit_id'] = 0;
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
                    return redirect()->route('centers.show', $id)->with('success', '     تم    بنجاح');
                }
            } else {
                return redirect()->back()->with('danger', 'يوجد تعارض في تاريخ العقد مع عقد أخر');
            }
        }

        // if ($request->has('btn_add_ohda')) {
        //     $this->validate($request, [
        //         'emp_id' => 'required',
        //         'purpose' => 'required',
        //         // 'center_id' => 'required',
        //         //  'maincenter_id' => 'required',
        //         'raseed' => 'required'

        //     ], [
        //         'emp_id' => 'يجب اختيار الموظف المسؤول',
        //         'purpose' => 'يجب تسجيل البيان ',
        //         // 'center_id' => 'required',
        //         //  'maincenter_id' => 'required',
        //         'raseed' => 'يجب تسجيل الرصيد'

        //     ]);

        //     DB::transaction(function () use ($request) {
        //         $ohda = Ohda::create([
        //             'emp_id'  => $request->emp_id,
        //             'purpose' => $request->purpose,
        //             'raseed'  => $request->raseed,
        //             'maincenter_id'  => $request->maincenter_id,
        //             'center_id'  => $request->center_id,
        //         ]);
        //     });
        // }


        $units =   Unit::with('center', 'unitType', 'renter')
            ->where('center_id', $id)
            ->orderby('id')
            ->get();



        $payments = Payment::with(['contract.renter', 'paymentType', 'employee'])
            ->wherehas('contract', fn($sql) => $sql->where('center_id', $id))
            ->where('status', 1)
            ->orderByDesc('id')
            ->get();

        $sarfs = Sarf::with(['sarfType', 'serviceType', 'payrool.employee', 'recipient', 'paymentType', 'sourceType', 'fromOhda.employee', 'toOhda.employee'])
            ->where('center_id', $id)
            ->orderByDesc('id')
            ->get();

        $files = All_file::where('object_name', 'centers')
            ->where('object_id', $id)
            ->get();

        $locations = Location::get();
        $types = Unit_type::get();
        $renters = Renter::get();

        $ohdas = Ohda::with(['employee', 'operatios.sarf'])
            ->where('center_id', $id)
            ->orderByDesc('id')
            ->get();
        //  dd( $ohdas) ;

        $sourceTypes = Source_type::get();
        $sarfTypes = Sarf_type::get();
        $payment_types = Payment_type::get();
        $serviceTypes = Service_type::get();
        $recipients = Recipient::get();

        $payrolls = Payroll::with(['employee'])
            ->where('payment_status', 0)
            ->get();

        $emps = Employee::get();
        $others = Othercontent::get();

        $contracts = Contract::with('renter', 'payments.contract.renter', 'payments.paymentType', 'payments.employee')
            ->where(function ($q) {
                $q->where('unit_id', 0)
                    ->orWhereNull('unit_id');
            })
            ->where('center_id', $id)
            ->orderByDesc('id')->get();


        return view('centers.show', compact('contracts', 'payrolls', 'others', 'recipients', 'serviceTypes', 'payment_types', 'sarfTypes', 'sourceTypes', 'center', 'emps', 'ohdas', 'files', 'renters', 'types', 'locations', 'payments', 'sarfs', 'current_user', 'units'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $center = Center::find($id);
        $current_user = User::find(Auth::user()->id);
        $locations = Location::get();
        $others = Othercontent::get();
        return view('centers.edit', compact('center', 'locations', 'others', 'current_user'));
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
            'center_name' => 'required',
            'center_location' => 'required'
            //  'woter_no' => 'required',
            //  'electric_no' => 'required'

        ], [
            'center_name' => 'يجب ادخال اسم العمارة',
            'center_location' => 'يجب اختيار الموقع'
            //  'woter_no' => 'required',
            //  'electric_no' => 'required'
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
        $center =  Center::find($id);
        if (isset($request->othercontents)) {
            $input['othercontents'] = implode(",", $request->othercontents);
        }

        $center->update($input);


        return redirect()->route('centers.show', $id)
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



        $center  = Center::find($id);
        $main_center_id = $center->maincenter_id;
        if (count($center->units) > 0) {
            return redirect()->route('maincenters.show', $main_center_id)
                ->with('danger', 'لا يمكن الحذف قبل ان تحذف جميع الشقق المسجلة    ');
        } else {
            $center->delete();
            return redirect()->route('maincenters.show', $main_center_id)
                ->with('success', 'تم الحذف بنجاح');
        }

        //

    }
}
