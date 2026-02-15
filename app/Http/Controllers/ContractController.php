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


class ContractController extends Controller
{
    private const INDEX_RELATIONS = ['maincenter', 'center', 'unit.unitType', 'renter'];

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


        $query = Contract::with(self::INDEX_RELATIONS)
            ->whereDate('end_date', '>=', Carbon::today());

        if ($request->filled('period_filter')) {

            switch ($request->period_filter) {

                // أقل من سنة
                case 'lt1':
                    $query->whereRaw("
                TIMESTAMPDIFF(MONTH, start_date, DATE_ADD(end_date, INTERVAL 1 DAY)) < 12
            ");
                    break;

                // سنة كاملة
                case '1y':
                    $query->whereRaw("
                TIMESTAMPDIFF(MONTH, start_date, DATE_ADD(end_date, INTERVAL 1 DAY)) = 12
            ");
                    break;

                // أكثر من سنة وأقل من سنتين
                case '1to2':
                    $query->whereRaw("
                TIMESTAMPDIFF(MONTH, start_date, DATE_ADD(end_date, INTERVAL 1 DAY)) > 12
                AND
                TIMESTAMPDIFF(MONTH, start_date, DATE_ADD(end_date, INTERVAL 1 DAY)) < 24
            ");
                    break;

                // سنتين كاملتين
                case '2y':
                    $query->whereRaw("
                TIMESTAMPDIFF(MONTH, start_date, DATE_ADD(end_date, INTERVAL 1 DAY)) = 24
            ");
                    break;

                // أكثر من سنتين
                case 'gt2':
                    $query->whereRaw("
                TIMESTAMPDIFF(MONTH, start_date, DATE_ADD(end_date, INTERVAL 1 DAY)) > 24
            ");
                    break;
            }
        }

        $contracts = $query
            ->orderByDesc('id')
            ->get();
        $current_user = User::find(Auth::user()->id);
        return view('contracts.index', compact('contracts', 'current_user'))->with('i', 0);
    }
    public function contract_arch(Request $request): View
    {


        $contracts = Contract::with(self::INDEX_RELATIONS)
            ->whereDate('end_date', '<', Carbon::today())
            ->orderByDesc('id')
            ->get();
        $current_user = User::find(Auth::user()->id);
        return view('contracts.contract_arch', compact('contracts', 'current_user'))->with('i', 0);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    public function check_e_no($e_no)
    {

        if (Contract::where('e_no', $e_no)->exists()) {
            return 1  ;      } else {
            return 0 ;
        }
    }

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
            $op .= '<option value="' . $unit->id . '"> ' . $unit->unitType->name . ' رقم : ' . $unit->unit_no . '   </option>';
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

    public function create(Request $request)
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
                return redirect()->route('contracts.create')->with('success', '     تم الاضافة  بنجاح');
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
                return redirect()->route('contracts.create')->with('success', '     تم الاضافة  بنجاح');
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
                return redirect()->route('contracts.create')->with('success', '     تم الاضافة  بنجاح');
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
        return view('contracts.create', compact('current_user', 'others', 'locations', 'emps', 'nationalities', 'id_types', 'centers', 'maincenters', 'types', 'renters'));
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
             'center_id' => 'required', 'maincenter_id' => 'required',//    'electric_no' => 'required'
        ], [//   'unit_description' => 'required',
             'center_id' => 'يجب اختيار العمارة', 'maincenter_id' => 'يجب اختيار المركز الرئيسي',//    'electric_no' => 'required'
        ]);

        $input = $request->all();
      //  $input['img'] = $img;
        $input['created_by'] = Auth::user()->id;
        // dd($input) ;
if($request->has('unit_id') && $request->unit_id!='')
{
    if (!$this->check_contract_dates($request->start_date, $request->end_date, $request->unit_id)) {
        return redirect()->back()->with('danger', 'يوجد تعارض في تاريخ العقد مع عقد أخر');
    }
}


            $contract_data =
            [
                "start_date"=>$request->start_date
                ,"start_dateh"=> Hijri::ShortDate($request->start_date)
                ,"e_no"=>$request->e_no
                ,"renter_id"=>$request->renter_id
                ,"notes"=>$request->c_notes
                ,"img"=>$img
                ,"maincenter_id"=>$request->maincenter_id
                ,"center_id"=>$request->center_id
                ,"unit_id"=>$request->unit_id
                ,"period_year"=>$request->period_year
                ,"period_month"=>$request->period_month
                ,"period_day"=>$request->period_day
                ,"delay_fine"=>$request->delay_fine
                ,"end_date"=>$request->end_date
                ,"end_dateh"=>Hijri::ShortDate($request->end_date)
                ,"year_amount"=>$request->year_amount
                ,"insurance_amount"=>$request->insurance_amount
                ,"services_amount"=>$request->services_amount
                ,"no_of_payments"=>$request->no_of_payments
                ,"start_payment_amount"=>$request->start_payment_amount
                ,"no_of_all_payments"=>$request->no_of_all_payments
                ,"total_amount"=>$request->total_amount
                ,"electric_no"=>$request->electric_no
                ,"water_no"=>$request->water_no
                ,"segel_togary"=>$request->segel_togary
                ,"img"=>$img

                ,"created_by"=>Auth::user()->id
            ] ;

        $contract = Contract::create($contract_data);
        if($contract)
        {
           if(count($request->payment_dates)>0)
           {
                for($i = 0 ; $i<count($request->payment_dates) ; $i++)
                {
                    if($request->payment_amounts[$i]>0)
                    {
                        $payment_data['contract_id'] = $contract->id;
                        $payment_data['status'] = 0;
                        $payment_data['maincenter_id'] = $request->maincenter_id;
                        $payment_data['center_id'] = $request->center_id;
                        $payment_data['unit_id'] = $request->unit_id;
                        $payment_data['created_by'] = Auth::user()->id;
                        $payment_data['p_date'] = $request->payment_dates[$i];
                        $payment_data['p_dateh'] = Hijri::ShortDate($request->payment_dates[$i]);
                        if($request->payment_for[$i] == 5 )
                            $payment_data['payment_no'] = '' ;
                        else
                        $payment_data['payment_no'] = $i+1 ;
                        $payment_data['notes'] = $request->payment_note[$i] ;
                        $payment_data['payment_for'] = $request->payment_for[$i] ;
                        $payment_data['amount'] = $request->payment_amounts[$i];
                        $payment_data['amount_txt'] = Tafqeet::arablic($request->payment_amounts[$i]);
                        Payment::create($payment_data);
                    }

                }
           }
        }

        return redirect()->route('contracts.index')->with('success', '     تم الاضافة  بنجاح');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id, Request $request)
    {
        $contract = Contract::with([
            'payments' => function ($query) {
                $query->orderBy('p_date', 'asc');
            },
            'payments.contract.renter',
            'payments.paymentType',
            'renter',
            'unit',
            'center',
            'events',
            'parent',
            'maincenter',
        ])->find($id);
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

//                    $nextPayment = Payment::where('contract_id',$payment->contract_id)
//                        ->where('status',0)
//                        ->where('id','>',$payment->id)
//                        ->orderBy('id')
//                        ->first();
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
                    return redirect()->route('contracts.edit', $id)->with('success', '     تم    بنجاح');
                }
            }
        }
        if ($request->has('btn_updatePayment')) {


            $payment = Payment::find($request->payment_id);
            if ($request->amount > 0) {
                $payment->amount = $request->amount;

                $payment->remender_amount = $request->true_amount - $request->amount;


                $payment->amount_txt = Tafqeet::arablic($request->amount);
                $payment->p_date = $request->p_date;
                $payment->p_dateh = $request->p_dateh;
                $payment->updated_by = Auth::user()->id;
                $payment->updated_at = Carbon::now();
                $payment->payment_type = $request->payment_type;


                if ($payment->save()) {
                    return redirect()->route('contracts.edit', $id)->with('success', '     تم    بنجاح');
                }
            }
        }
        $maincenters = Maincenter::get();
//        $centers =$contract->maincenter->centers ;
//        $units = $contract->center->units ;
        //dd($maincenters,$centers,$units ) ;
        $centers =Center::get() ;
        $units = Unit::get() ;


        $renters = Renter::get();
        //dd($contract , $contract->contractPeriod()) ;
        $payment_types = Payment_type::all();
        $files = All_file::where('object_name', 'contracts')->where('object_id', $id)->get();

        return view('contracts.edit', compact('files','payment_types','contract','maincenters', 'current_user', 'centers', 'units',  'renters'));
    }
 public function show($id, Request $request)
    {
        $contract = Contract::with([
            'payments' => function ($query) {
                $query->orderBy('p_date', 'asc');
            },
            'payments.contract.renter',
            'payments.paymentType',
            'renter',
            'unit',
            'center',
            'events',
            'parent',
            'maincenter',
        ])->find($id);
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

//                    $nextPayment = Payment::where('contract_id',$payment->contract_id)
//                        ->where('status',0)
//                        ->where('id','>',$payment->id)
//                        ->orderBy('id')
//                        ->first();
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
                    return redirect()->route('contracts.edit', $id)->with('success', '     تم    بنجاح');
                }
            }
        }
        if ($request->has('btn_updatePayment')) {


            $payment = Payment::find($request->payment_id);
            if ($request->amount > 0) {
                $payment->amount = $request->amount;

                $payment->remender_amount = $request->true_amount - $request->amount;


                $payment->amount_txt = Tafqeet::arablic($request->amount);
                $payment->p_date = $request->p_date;
                $payment->p_dateh = $request->p_dateh;
                $payment->updated_by = Auth::user()->id;
                $payment->updated_at = Carbon::now();
                $payment->payment_type = $request->payment_type;


                if ($payment->save()) {
                    return redirect()->route('contracts.edit', $id)->with('success', '     تم    بنجاح');
                }
            }
        }
        $maincenters = Maincenter::get();
//        $centers =$contract->maincenter->centers ;
//        $units = $contract->center->units ;
        //dd($maincenters,$centers,$units ) ;
        $centers =Center::get() ;
        $units = Unit::get() ;


        $renters = Renter::get();
        //dd($contract , $contract->contractPeriod()) ;
        $payment_types = Payment_type::all();
        $files = All_file::where('object_name', 'contracts')->where('object_id', $id)->get();

        return view('contracts.edit', compact('files','payment_types','contract','maincenters', 'current_user', 'centers', 'units',  'renters'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */



    function generatePaymentsFromContract($contract)
    {
        $payment_data = [];

        $startDateVal        = Carbon::parse($contract->start_date);
        $endDateVal          = Carbon::parse($contract->end_date);
        $yearAmount          = (float) $contract->year_amount;
        $noOfPayments        = (int) $contract->no_of_payments;
        $noOfAllPayments     = (int) $contract->no_of_all_payments;
        $totalAmount         = (float) $contract->total_amount;

        $servicesAmount      = (float) ($contract->services_amount ?? 0);
        $insuranceAmount     = (float) ($contract->insurance_amount ?? 0);
        $startPaymentAmount  = (float) ($contract->start_payment_amount ?? 0);

        if (!$startDateVal || !$endDateVal || $yearAmount <= 0 || $noOfPayments <= 0) {
            return [];
        }

        $daysBetweenPayments = floor(365 / $noOfPayments);
        $singlePaymentAmount = round($yearAmount / $noOfPayments, 2);

        $currentPaymentDate  = $startDateVal->copy();
        $sumAmount           = 0;
        $paymentNo           = 1;

        /*
        |--------------------------------------------------------------------------
        | الدفعة المقدمة (العربون)
        |--------------------------------------------------------------------------
        */
        if ($startPaymentAmount > 0) {
            $payment_data[] = [
                'p_date'        => $currentPaymentDate->toDateString(),
                'payment_no'    => $paymentNo++,
                'notes'         => 'الدفعة المقدمة (العربون)',
                'payment_for'   => 5,
                'amount'        => $startPaymentAmount,
            ];

            $sumAmount += $startPaymentAmount;
        }

        /*
        |--------------------------------------------------------------------------
        | مبلغ التأمين
        |--------------------------------------------------------------------------
        */
        if ($insuranceAmount > 0) {
            $payment_data[] = [
                'p_date'        => $currentPaymentDate->toDateString(),
                'payment_no'    => $paymentNo++,
                'notes'         => 'مبلغ التأمين',
                'payment_for'   => 2,
                'amount'        => $insuranceAmount,
            ];
        }

        $countPayments = 0;
        $cycles = floor($noOfAllPayments / $noOfPayments);

        /*
        |--------------------------------------------------------------------------
        | الدفعات المتكررة
        |--------------------------------------------------------------------------
        */
        for ($i = 1; $i <= $cycles; $i++) {

            // قيمة الخدمات
            if ($servicesAmount > 0) {
                $payment_data[] = [
                    'p_date'        => $currentPaymentDate->toDateString(),
                    'payment_no'    => $paymentNo++,
                    'notes'         => 'قيمة الخدمات',
                    'payment_for'   => 3,
                    'amount'        => $servicesAmount,
                ];
            }

            $startPaymentDone = false;

            for ($j = 1; $j <= $noOfPayments && $countPayments < $noOfAllPayments; $j++) {

                if ($sumAmount >= $totalAmount) {
                    break;
                }

                $paymentValue = $singlePaymentAmount;

                if ($i == 1 && $startPaymentAmount > 0 && !$startPaymentDone) {
                    $paymentValue = max(0, $singlePaymentAmount - $startPaymentAmount);
                    $startPaymentDone = true;
                }

                if (($sumAmount + $paymentValue) > $totalAmount) {
                    break;
                }

                $payment_data[] = [
                    'p_date'        => $currentPaymentDate->toDateString(),
                    'payment_no'    => $paymentNo++,
                    'notes'         => 'دفعة إيجار',
                    'payment_for'   => 1,
                    'amount'        => $paymentValue,
                ];

                $sumAmount += $paymentValue;
                $currentPaymentDate->addDays($daysBetweenPayments);
                $countPayments++;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | آخر دفعة في حال وجود فرق
        |--------------------------------------------------------------------------
        */
        if ($sumAmount < $totalAmount) {

            $lastValue = round($totalAmount - $sumAmount, 2);

            $payment_data[] = [
                'p_date'        => $currentPaymentDate->toDateString(),
                'payment_no'    => $paymentNo++,
                'notes'         => 'دفعة إيجار',
                'payment_for'   => 1,
                'amount'        => $lastValue,
            ];
        }

        return $payment_data;
    }

    public function reUpdatePayments(Contract $contract)
    {
        $contract->payments()->delete();
        $payments = $this->generatePaymentsFromContract($contract);

        foreach ($payments as $i => $p) {

            Payment::create([
                'contract_id'   => $contract->id,
                'status'        => 0,
                'maincenter_id' => $contract->maincenter_id,
                'center_id'     => $contract->center_id,
                'unit_id'       => $contract->unit_id,
                'created_by'    => Auth::id(),

                'p_date'        => $p['p_date'],
                'p_dateh'       => Hijri::ShortDate($p['p_date']),
                'payment_no'    => $p['payment_no'],
                'notes'         => $p['notes'],
                'payment_for'   => $p['payment_for'],
                'amount'        => $p['amount'],
                'amount_txt'    => Tafqeet::arablic($p['amount']),
            ]);
        }




    }
    public function update(Request $request, $id): RedirectResponse
    {
        $img = '';
        if ($request->has('file')) {
            $uploadedFile = $request->file('file');
            $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
            $img = $uploadedFile->storeAs('uploads', $storedName, 'public');
        }

        $this->validate($request, [//   'unit_description' => 'required',
            'center_id' => 'required', 'maincenter_id' => 'required',//    'electric_no' => 'required'
        ], [//   'unit_description' => 'required',
            'center_id' => 'يجب اختيار العمارة', 'maincenter_id' => 'يجب اختيار المركز الرئيسي',//    'electric_no' => 'required'
        ]);

        $input = $request->all();
        //  $input['img'] = $img;
        $input['created_by'] = Auth::user()->id;
        // dd($input) ;
        $contract_data =
            [
                "start_date"=>$request->start_date
                ,"start_dateh"=>Hijri::ShortDate($request->start_date)
                ,"e_no"=>$request->e_no
                ,"renter_id"=>$request->renter_id
                ,"notes"=>$request->c_notes
                ,"img"=>$img
                ,"maincenter_id"=>$request->maincenter_id
                ,"center_id"=>$request->center_id
                ,"unit_id"=>$request->unit_id
                ,"period_year"=>$request->period_year
                ,"period_month"=>$request->period_month
                ,"period_day"=>$request->period_day
                ,"delay_fine"=>$request->delay_fine
                ,"end_date"=>$request->end_date
                ,"end_dateh"=>Hijri::ShortDate($request->end_date)
                ,"year_amount"=>$request->year_amount
                ,"insurance_amount"=>$request->insurance_amount
                ,"services_amount"=>$request->services_amount
                ,"no_of_payments"=>$request->no_of_payments
                ,"start_payment_amount"=>$request->start_payment_amount
                ,"no_of_all_payments"=>$request->no_of_all_payments
                ,"electric_no"=>$request->electric_no
                ,"water_no"=>$request->water_no
                ,"segel_togary"=>$request->segel_togary
                ,"total_amount"=>$request->total_amount

        ] ;

        $contract = Contract::findOrFail($id);

        $contract_data['updated_by'] = Auth::id();
        $rupdatePayments = false ;
//        if($contract->total_amount != $request->total_amount
//        || $contract->start_payment_amount != $request->start_payment_amount
//        || $contract->no_of_all_payments != $request->no_of_all_payments
//        || $contract->no_of_payments != $request->no_of_payments
//        || $contract->services_amount != $request->services_amount
////        || $contract->insurance_amount != $request->insurance_amount
//        || $contract->year_amount != $request->year_amount
//        )
//        {
//            $rupdatePayments = true ;
//        }
        if ($contract->update($contract_data)) {

            if($rupdatePayments)
               $this->reUpdatePayments($contract) ;
            return redirect()
                ->route('contracts.index')
                ->with('success', 'تم التعديل بنجاح');
        }

        return redirect()
            ->back()
            ->with('danger', 'لم يتم الحفظ');

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
