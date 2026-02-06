<?php

namespace App\Http\Controllers;

use AliAbdalla\Tafqeet\Core\Tafqeet;
use Alkoumi\LaravelHijriDate\Hijri;
use App\Models\All_file;
use App\Models\Center;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\Id_type;
use App\Models\Location;
use App\Models\Maincenter;
use App\Models\Nationality;
use App\Models\Notification;
use App\Models\Ohda;
use App\Models\Ohdas_operation;
use App\Models\Othercontent;
use App\Models\Payment;
use App\Models\Payment_type;
use App\Models\Payroll;
use App\Models\Recipient;
use App\Models\Renter;
use App\Models\Sarf;
use App\Models\Unit;
use App\Models\Unit_type;
use App\Models\User;
use Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;


class UnitController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request): View
    {
        $amount = 7587;
        $arablic = Tafqeet::arablic($amount);

        $data = Unit::with('center', 'unitType', 'renter')->orderby('center_id')->get();

        $current_user = User::find(Auth::user()->id);
        return view('units.index', compact('data', 'current_user'))->with('i', 0);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    public function delete_object($id, $object_type)
    {
        $i = 0;
        switch ($object_type) {
            case 'unit':
                $ob = Unit::find($id);
                if($ob->delete()) $i = 1;
                break;
            case 'renter':
                $ob = Renter::find($id);
                if($ob->delete()) $i = 1;
                break;
            case 'center':
                $ob = Center::find($id);
               if($ob->delete()) $i = 1;
                break;
            case 'maincenter':
                $ob = Maincenter::find($id);
                if($ob->delete()) $i = 1;
                break;
            case 'payment':
                $ob = Payment::find($id);
               if($ob->delete()) $i = 1;
                break;
            case 'contract':
                $ob = Contract::find($id);
               if($ob->delete()) $i = 1;
                break;
            case 'payroll':
                $ob = Payroll::find($id);
                $sarf= $ob->sarf;
                if($sarf )
                {
                    $ohda = Ohda::find($sarf->from_ohda_id);
                    $ohda->raseed += $sarf->amount;
                    $ohda->save();
                    $ohda_op = Ohdas_operation::where('ohda_id',$ohda->id)
                        ->where('sarf_id',$sarf->id)->first();
                    $ohda_op->delete() ;
                }

               if($ob->delete()) $i = 1;
                break;
            case 'employee':
                $ob = Employee::find($id);
              if($ob->delete()) $i = 1;
                break;
            case 'ohda':
                $ob = Ohda::find($id);
               if($ob->delete()) $i = 1;
                break;
            case 'operation' :
                $ob = Ohdas_operation::find($id);
               if($ob->delete()) $i = 1;
                break;
            case'recipient' :
                $ob = Recipient::find($id);
              if($ob->delete()) $i = 1;
                break;
            case'sarf' :
                $ob = Sarf::find($id);
               if($ob->delete()) $i = 1;
                break;
            case 'vacation' :
                $ob = Vacation::find($id);
              if($ob->delete()) $i = 1;
                break;

        }


         return $i;
    }

    public function get_units($id)
    {

        $units = Unit::with('center', 'unitType')->where('center_id', $id)->orderby('id')->get();

        $op = '<option value="">اختر </option>';
        foreach ($units as $unit) {
            $op .= '<option value="' . $unit->id . '"> ' . $unit->unitType->name . ' رقم : ' . $unit->unit_no . ' '.$unit->unit_description.'  </option>';
        }
        return $op;
    }

    public function get_centers($id)
    {

        $centers = Center::where('maincenter_id', $id)->orderby('id')->get();

        $op = '<option value="x" selected >اختر </option>';
        $op .= '<option value="0">  اضافة عمارة جديدة    </option>';
        foreach ($centers as $row) {
            $op .= '<option value="' . $row->id . '"> ' . $row->center_name . '    </option>';
        }
        return $op;
    }

    public function get_center2($id)
    {

        $centers = Center::where('maincenter_id', $id)->orderby('id')->get();

        $op = '<option value="x" selected >اختر </option>';

        foreach ($centers as $row) {
            $op .= '<option value="' . $row->id . '"> ' . $row->center_name . '    </option>';
        }
        return $op;
    }

    public function add_unit(Request $request)
    {


        if ($request->has('btn_addMainCenter')) {
            $img = '';
            if ($request->has('file')) {
                $uploadedFile = $request->file('file');
                $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
                $img = $uploadedFile->storeAs('uploads', $storedName, 'public');
            }

            $this->validate($request, ['name' => 'required',//   'iban'   => ['required', 'regex:/^SA\d{22}$/'],
            ], ['name' => 'يجب تسجيل الاسم',//   'iban.regex'   => 'IBAN يجب ان يبدأ ب SA  ويتبعه 22 رقم .',

            ]);

            $input = $request->all();
            $input['img'] = $img;
            $input['created_by'] = Auth::user()->id;
            // dd($input) ;
            $center = Maincenter::create($input);
            if ($center) {
                return redirect()->route('units.add_unit')->with('success', '     تم الاضافة  بنجاح');
            }
        }

        if ($request->has('btn_add_center')) {

            $img = '';
            if ($request->has('file')) {
                $uploadedFile = $request->file('file');
                $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
                $img = $uploadedFile->storeAs('uploads', $storedName, 'public');
            }

            $this->validate($request, ['center_name' => 'required', 'center_location' => 'required', //    'woter_no' => 'required',
                //   'electric_no' => 'required',
                'maincenter_id' => 'required'], ['center_name' => 'يجب ادخال اسم العمارة', 'center_location' => 'يجب اختيار الموقع', 'maincenter_id' => 'يجب اختيار المركز الرئيسي '

                //  'woter_no' => 'required',
                //  'electric_no' => 'required'
            ]);

            $input = $request->all();
            $input['img'] = $img;
            $input['created_by'] = Auth::user()->id;
            if (isset($request->othercontents)) {
                $input['othercontents'] = implode(",", $request->othercontents);
            }
            $center = Center::create($input);
            if ($center) {
                return redirect()->route('units.add_unit')->with('success', '     تم الاضافة  بنجاح');
            }
        }


        if ($request->has('btn_add_unit')) {
            $input = $request->all();

            /*
                1 - اضافة المستأجر ان لم يكن مسجل
                2 - اضافة بيانات الشقة
                3 - اضافة العقد
                4- اضافة الدفعات



                */
            if ($request->current_renter_id == 0) {
                $img = '';
                if ($request->has('id_file')) {
                    $uploadedFile = $request->file('id_file');
                    $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
                    $img = $uploadedFile->storeAs('uploads', $storedName, 'public');
                }
                $work_letter = '';
                if ($request->has('work_letter')) {
                    $uploadedFile = $request->file('work_letter');
                    $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
                    $work_letter = $uploadedFile->storeAs('uploads', $storedName, 'public');
                }

                $this->validate($request, ['name' => 'required', //   'id_no' => 'required',
                    'nationality' => 'required',//   'mobile_no' => 'required'

                ], ['name' => 'يجب تسجيل الاسم', //   'id_no' => 'required',
                    'nationality' => 'يجب اختيار الجنسية',//   'mobile_no' => 'required'

                ]);


                $input['img'] = $img;
                $input['work_letter'] = $work_letter;
                $input['notes'] = $request->r_notes;
                $input['created_by'] = Auth::user()->id;
                // dd($input) ;
                $renter = Renter::create($input);
                $input['current_renter_id'] = $renter->id;
                //  dd($renter ,$request->current_renter_id ) ;
            }
            $img = '';
            if ($request->has('file')) {
                $uploadedFile = $request->file('file');
                $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
                $img = $uploadedFile->storeAs('uploads', $storedName, 'public');
            }

            $this->validate($request, [//   'unit_description' => 'required',
                'unit_type' => 'required', 'center_id' => 'required', 'maincenter_id' => 'required',//    'electric_no' => 'required'
            ], [//   'unit_description' => 'required',
                'unit_type' => 'يجب اختيار نوع الوحدة ', 'center_id' => 'يجب اختيار العمارة', 'maincenter_id' => 'يجب اختيار المركز الرئيسي',//    'electric_no' => 'required'
            ]);


            $input['img'] = $img;
            $input['notes'] = $request->notes;
            $input['created_by'] = Auth::user()->id;

            $unit = Unit::create($input);
            if ($unit && $input['current_renter_id'] != '' && $input['current_renter_id'] > 0) {
                $input['unit_id'] = $unit->id;

                $start_date = $request->start_date;
                $input['start_dateh'] = Hijri::ShortDate($request->start_date);
                $end_date = $request->end_date;
                $input['end_dateh'] = Hijri::ShortDate($request->end_date);
                $input['renter_id'] = $input['current_renter_id'];

                $date1 = date_create($start_date);
                $date2 = date_create($end_date);

                $no_of_all_days = date_diff($date1, $date2)->format('%a');
                /*
مراجعة نظام الدفعات بناءا على التالي
             "period_year" => "2"
                    "period_month" => "10"


*/
                //  dd($input) ;

                if ($this->check_contract_dates($request->start_date, $request->end_date, $unit->id)) {
                    if ($contract = Contract::create($input)) {

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


                        if ($request->period_year > 0) {
                            $no_of_section_days = (int)floor(365 / $request->no_of_payments);
                        }


                        $payment_data['contract_id'] = $contract->id;
                        $payment_data['status'] = 0;
                        $payment_data['maincenter_id'] = $request->maincenter_id;
                        $payment_data['center_id'] = $request->center_id;
                        $payment_data['unit_id'] = $unit->id;
                        $payment_data['created_by'] = Auth::user()->id;
                        $payment_data['p_date'] = $start_date;
                        $payment_data['p_dateh'] = Hijri::ShortDate($start_date);
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
                        if ($request->period_year > 0) {
                            for ($y = 0; $y < $request->period_year; $y++) {
                                for ($i = 0; $i < $request->no_of_payments; $i++) {
                                    $payment_data['payment_no'] = $i + 1;
                                    Payment::create($payment_data);
                                    $payment_data['p_date'] = (new Carbon($payment_data['p_date']))->addDays($no_of_section_days)->format('Y/m/d');
                                    $payment_data['p_dateh'] = Hijri::ShortDate($payment_data['p_date']);
                                }
                            }
                        }

                        if ($request->period_month > 0) {
                            $n_days = 30 * $request->period_month;
                            if ($request->period_year == 0) {
                                $no_of_section_days = (int)floor($n_days / $request->no_of_payments);
                            }
                            $date1 = date_create($payment_data['p_date']);
                            $i = 0;
                            while (date_diff($date1, $date2)->format('%a') > $no_of_section_days) {
                                $payment_data['payment_no'] = ++$i;
                                Payment::create($payment_data);
                                $payment_data['p_date'] = (new Carbon($payment_data['p_date']))->addDays($no_of_section_days)->format('Y/m/d');
                                $payment_data['p_dateh'] = Hijri::ShortDate($payment_data['p_date']);
                                $date1 = date_create($payment_data['p_date']);
                            }
                        }
                    }
                } else {
                    return redirect()->back()->with('danger', 'يوجد تعارض في تاريخ العقد مع عقد أخر');
                }
            }
            if ($unit) {
                return redirect()->route('units.add_unit')->with('success', '     تم الاضافة  بنجاح');
            }
        }

        $current_user = User::find(Auth::user()->id);

        $maincenters = Maincenter::get();
        $centers = Center::get();
        $nationalities = Nationality::get();
        $types = Unit_type::get();
        $renters = Renter::get();
        $id_types = Id_type::all();
        $emps = Employee::get();
        $locations = Location::get();
        $others = Othercontent::get();
        return view('units.add_unit', compact('current_user', 'others', 'locations', 'emps', 'nationalities', 'id_types', 'centers', 'maincenters', 'types', 'renters'));
    }

    public function create(): View
    {

        $current_user = User::find(Auth::user()->id);
        $centers = Center::get();
        $types = Unit_type::get();
        $renters = Renter::get();
        return view('units.create', compact('current_user', 'centers', 'types', 'renters'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */


    public function check_contract_dates($start_date, $end_date, $unit_id)
    {

        $sql = "SELECT count(*) c FROM `contracts` WHERE
         unit_id = " . $unit_id . " and
                    (start_date BETWEEN '" . $start_date . "' and '" . $end_date . "'
                   or end_date BETWEEN '" . $start_date . "' and '" . $end_date . "' )     ";
        $res = DB::select($sql)[0];
        if ($res->c > 0) return false; else
            return true;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): RedirectResponse
    {

        $img = '';
        if ($request->has('file')) {
            $uploadedFile = $request->file('file');
            $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
            $img = $uploadedFile->storeAs('uploads', $storedName, 'public');
        }

        $this->validate($request, [//   'unit_description' => 'required',
            'unit_type' => 'required', 'center_id' => 'required', 'maincenter_id' => 'required',//    'electric_no' => 'required'
        ], [//   'unit_description' => 'required',
            'unit_type' => 'يجب اختيار نوع الوحدة ', 'center_id' => 'يجب اختيار العمارة', 'maincenter_id' => 'يجب اختيار المركز الرئيسي',//    'electric_no' => 'required'
        ]);

        $input = $request->all();
        $input['img'] = $img;
        $input['created_by'] = Auth::user()->id;
        // dd($input) ;
        $unit = Unit::create($input);


        return redirect()->route('centers.show', $unit->center_id)->with('success', '     تم الاضافة  بنجاح');
    }

    public function show($id, Request $request)
    {
        // Request $request


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
                    return redirect()->route('units.show', $id)->with('success', '     تم    بنجاح');
                }
            }
        }

        if ($request->has('btn_add_contract')) {

            $this->validate($request, ['start_date' => 'required', 'end_date' => 'required',

                'no_of_payments' => 'required', 'year_amount' => 'required', 'renter_id' => 'required', 'unit_id' => 'required', 'maincenter_id' => 'required', 'center_id' => 'required'], ['start_date' => 'يجب اختيار بداية العقد', 'end_date' => 'يجب اختيار نهاية العقد',

                'no_of_payments' => 'يجب تسجيل عدد الدفعات بالسنة ', 'year_amount' => 'يجب اختيار قيمة الايجار بالسنة', 'renter_id' => 'يجب اختيار المستأجر', 'unit_id' => 'يجب اختيار الوحدة (الشقه او المحل) ', 'maincenter_id' => 'يجب اختيار المركز الرئيسي', 'center_id' => 'يجب اختيار العمارة']);

            $input = $request->all();

            $input['created_by'] = Auth::user()->id;

            $start_date = $request->start_date;
            $end_date = $request->end_date;

            $date1 = date_create($start_date);
            $date2 = date_create($end_date);

            $no_of_all_days = date_diff($date1, $date2)->format('%a');
            if ($this->check_contract_dates($request->start_date, $request->end_date, $request->unit_id)) {
                if ($contract = Contract::create($input)) {

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


                    $no_of_section_days = (int)floor($no_of_all_days / $request->no_of_payments);
                    $payment_data['contract_id'] = $contract->id;
                    $payment_data['status'] = 0;
                    $payment_data['maincenter_id'] = $request->maincenter_id;
                    $payment_data['center_id'] = $request->center_id;
                    $payment_data['unit_id'] = $request->unit_id;
                    $payment_data['created_by'] = Auth::user()->id;
                    $payment_data['p_date'] = $start_date;
                    $payment_data['p_dateh'] = Hijri::ShortDate($start_date);
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
                        $payment_data['p_dateh'] = Hijri::ShortDate($payment_data['p_date']);
                    }
                    return redirect()->route('units.show', $id)->with('success', '     تم    بنجاح');
                }
            } else {
                return redirect()->back()->with('danger', 'يوجد تعارض في تاريخ العقد مع عقد أخر');

            }
        }

        $unit = Unit::with('center', 'unitType', 'renter', 'contracts')->find($id);
        if (is_null($unit)) {
            return redirect()->back()->with('danger', 'لا يوجد بيانات مطابقة');
        }
        $contracts = Contract::with('renter', 'payments.contract.renter', 'payments.paymentType', 'payments.employee')->where('unit_id', $unit->id)->orderByDesc('id')->get();

        $sql_current_contract = "SELECT id as currnet_contract_id FROM `contracts` WHERE unit_id = " . $id . " and now() BETWEEN start_date and end_date LIMIT 1";
        $res = DB::select($sql_current_contract);
        if (!empty($res)) $currnet_contract_id = $res[0]->currnet_contract_id; else
            $currnet_contract_id = '';

        // $payments = Payment::with(['contract' => function (Builder $query )use($unit->id) {
        // $query->where('unit_id','=', $unit->id);
        //     }])->get();

        $payments = Payment::with(['contract.renter', 'paymentType', 'employee'])->wherehas('contract', fn($sql) => $sql->where('unit_id', $unit->id))->get();
        //dd($payments[0]->contract->renter) ;

        $sarfs = Sarf::with(['sarfType', 'serviceType', 'payrool.employee', 'recipient', 'paymentType', 'sourceType', 'fromOhda.employee', 'toOhda.employee'])->where('unit_id', $unit->id)->orderByDesc('id')->get();


        $renters = Renter::all();
        $emps = Employee::all();
        $payment_types = Payment_type::all();

        $types = Unit_type::get();
        $renters = Renter::get();
        $files = All_file::where('object_name', 'units')->where('object_id', $id)->get();

        $current_user = User::find(Auth::user()->id);

        //dd($contracts) ;
        return view('units.show', compact('currnet_contract_id', 'unit', 'files', 'sarfs', 'types', 'renters', 'emps', 'payment_types', 'current_user', 'renters', 'contracts', 'payments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id): View
    {
        $unit = Unit::find($id);
        $current_user = User::find(Auth::user()->id);
        $centers = Center::get();
        $types = Unit_type::get();
        $renters = Renter::get();

        return view('units.edit', compact('unit', 'current_user', 'centers', 'types', 'renters'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id): RedirectResponse
    {

        $this->validate($request, [//  'unit_description' => 'required',
            'unit_type' => 'required', 'center_id' => 'required', 'maincenter_id' => 'required',//  'electric_no' => 'required'
        ], [//  'unit_description' => 'required',
            'unit_type' => 'يجب اختيار نوع الوحدة', 'center_id' => 'يجب اختيار العمارة', 'maincenter_id' => 'يجب اختيار المركز الرئيسي',//  'electric_no' => 'required'
        ]);

        $input = $request->all();
        if ($request->has('file')) {
            $uploadedFile = $request->file('file');
            $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
            $img = $uploadedFile->storeAs('uploads', $storedName, 'public');
            $input['img'] = $img;
        }

        $input['updated_by'] = Auth::user()->id;

        $unit = Unit::find($id);


        $unit->update($input);


        return redirect()->route('units.show', $id)->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id): RedirectResponse
    {
        $unit = Unit::find($id);
        $center_id = $unit->center_id;

        if (count($unit->contracts) > 0) {
            return redirect()->route('centers.show', $center_id)->with('danger', 'لا يمكن الحذف قبل ان تحذف جميع العقود المسجلة    ');
        } else {
            $unit->delete();
            return redirect()->route('centers.show', $center_id)->with('success', 'تم الحذف بنجاح');
        }

    }
}
