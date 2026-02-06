<?php

namespace App\Http\Controllers;

use AliAbdalla\Tafqeet\Core\Tafqeet;
use Alkoumi\LaravelHijriDate\Hijri;
use App\Models\Ohda;
use App\Models\Ohdas_operation;
use App\Models\Payment_type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Center;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Sarf;
use App\Models\Vacation;
use App\Models\Notification;
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
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Carbon;



class PayrollController extends Controller
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

    public function check_vac_dates($start_date, $end_date , $emp_id)
    {

        $sql = "SELECT count(*) c FROM `vacations` WHERE
                    start_date BETWEEN '" . $start_date . "' and '" . $end_date . "'
                   or end_date BETWEEN '" . $start_date . "' and '" . $end_date . "'
                   and emp_id = ".$emp_id
                   ;
        $res = DB::select($sql)[0];
        if ($res->c > 0)
            return false;
        else
            return true;
    }
    public function get_vac($start_date, $end_date, $emp_id)
    {

        $sql = "SELECT * FROM `vacations` WHERE
                   ( start_date BETWEEN '" . $start_date . "' and '" . $end_date . "'
                   or end_date BETWEEN '" . $start_date . "' and '" . $end_date . "' )
                   and emp_id = " . $emp_id;
        return DB::select($sql);
    }

    public   function days_in_month($month, $year)

    {

        // calculate number of days in a month

        return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
    }

    function countLeaveDaysInMonth($leaveStart, $leaveEnd, $month, $year)
    {
        // تحويل التواريخ إلى كائنات DateTime
        $leaveStart = new DateTime($leaveStart);
        $leaveEnd   = new DateTime($leaveEnd);

        // بداية ونهاية الشهر المطلوب
        $monthStart = new DateTime("$year-$month-01");
        $monthEnd   = (clone $monthStart)->modify('last day of this month');

        // نحسب التقاطع بين الفترتين
        $periodStart = $leaveStart > $monthStart ? $leaveStart : $monthStart;
        $periodEnd   = $leaveEnd < $monthEnd ? $leaveEnd : $monthEnd;

        if ($periodStart > $periodEnd) {
            return 0; // لا يوجد تقاطع
        }

        // عدد الأيام (مع حساب اليوم الأخير)
        return $periodStart->diff($periodEnd)->days + 1;
    }
    public function index(Request $request)
    {
        $current_user = User::find(Auth::user()->id) ;
        $result = null ;
       // $e = new EmployeeController ()  ;
       // dd($e->test() );
        if($request->has("btn_add_payroll"))
        {

            $salary_year_month = $request->year."/".$request->month;
           // dd($salary_year_month);

                $sql = " SELECT e.id emp_id , e.name , e.salary , p.id payrolle_id , '".$salary_year_month."' as salary_year_month , p.basic_salary  ,p.deductions ,p.deductions_purpose , p.net_salary , p.payment_status , p.p_date , p.p_dateh , s.id sarf_id , s.amount , s.year_m , s.sereal , s.s_desc   FROM `employees` e
                LEFT JOIN payrolls  p on (e.id = p.emp_id and salary_year_month = '".$salary_year_month."')
                LEFT JOIN sarfs s on (p.id = s.pay_role_id)
                where e.salary > 0  and e.salary is not null " ;
                $result = DB::select($sql) ;
            $employees[][] = null ;
                foreach ($result as  $employee) {

                    $days_in_month = $this->days_in_month($request->month, $request->year);
                    $salary_year_month = $request->year . "/" . $request->month;

                    //  هل يوجد اجازة
                    $date1 = '01/' . $request->month . '/' . $request->year;
                    $date2 =  $days_in_month . '/' . $request->month . '/' . $request->year;

                    $vac = $this->get_vac($date1, $date2, $employee->emp_id);

                    if (!empty($vac)) {
                        $vacation = $vac[0];
                        $no_of_leave_dayes = $this->countLeaveDaysInMonth($vacation->start_date, $vacation->end_date, $request->month, $request->year);
                    } else {
                        $no_of_leave_dayes = 0;
                    }

                    $mony_day = $employee->salary / $days_in_month;
                    $deductions = abs($mony_day * $no_of_leave_dayes);
                    $employee->deductions = $deductions ;
                    if ($deductions > 0)
                        $employee->deductions_purpose = 'ايام الاجازة ';
                    else
                        $employee->deductions_purpose = '';

                }

               // dd($result);
            $ohdas = Ohda::get() ;
            $payment_types = Payment_type::whereNotIn('id',[3,4,5,7])->get();
            return view('payrolls.index',compact('payment_types','ohdas','current_user','result','salary_year_month'));

        }


//        $data = Payroll::with('employee','sarf')->get();
//
//        $employees = Employee::get();


        return view('payrolls.index',compact('current_user'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

//        $current_user = User::find(Auth::user()->id) ;
//         $centers = Center::get();
//        return view('employees.create',compact('current_user','centers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function savePayroll(Payroll $payroll , $from_ohda_id)
    {
        $sarf = Sarf::where('pay_role_id', $payroll->id)->first();
        $input['source_type_id'] = 2;
        $input['sarf_type_id'] = 3;
        $input['from_ohda_id'] = $from_ohda_id;
        $input['p_date'] = $payroll->p_date;
        $input['p_dateh'] = $payroll->p_dateh;
        $input['amount'] = $payroll->net_salary;

        $input['payment_type'] = $payroll->payment_type;
        $input['s_desc'] = 'راتب شهر ' . $payroll->salary_year_month    ;
        $input['receved_by'] = $payroll->employee->name;

        $input['amount_txt'] = Tafqeet::arablic($payroll->net_salary);

        $input['year_m']  = substr($payroll->p_date, 2, 2);
        $input['year_h']  = substr($payroll->p_dateh, 2, 2);
        $sql = "SELECT nvl(max(sereal),0)+1 as sereal from sarfs where year_m = '" . $input['year_m'] . "'";

        $res = DB::select($sql)[0];
        $input['sereal'] = $res->sereal;

            if($sarf)
            {
                if($sarf->amount != $input['amount'])
                {
                    $ohda = Ohda::find($sarf->from_ohda_id);
                    $ohda_op = Ohdas_operation::where('ohda_id',$ohda->id)
                        ->where('sarf_id',$sarf->id)->first();
                    $ohda_op->amount = $input['amount'];
                    $ohda_op->save();
                    if($input['amount'] > $sarf->amount )
                        $ohda->raseed -= $input['amount'] - $sarf->amount  ;
                    else
                        $ohda->raseed += $sarf->amount - $input['amount']   ;
                    $ohda->save();


                }

                $input['updated_by'] = Auth::user()->id;
                $input['receved_by'] = $payroll->employee->name;
                $sarf->update($input);
                $payroll->payment_status = 1;
                $payroll->save();
            }
            else
            {
                $input['created_by'] = Auth::user()->id;
                $input['pay_role_id'] = $payroll->id    ;

                $sarf =  Sarf::create($input) ;
                $payroll->payment_status = 1;
                $payroll->save();
                // add Notification
                $toUsers = User::where('is_admin', 1)->get();
                foreach ($toUsers as $user) {
                    $n_date['user_id'] = $user->id;
                    $n_date['message'] = "تم صرف مبلغ : " . $sarf->amount;
                    $n_date['url'] = "sarfs.show";
                    $n_date['element_id'] = $sarf->id;
                    Notification::create($n_date);
                }
                if ($sarf->from_ohda_id != '') {
                    $ohda = Ohda::find($sarf->from_ohda_id);
                    $last_amount = $ohda->raseed;
                    $ohda->raseed = $ohda->raseed - $sarf->amount;
                    if ($ohda->save()) {
                        $odata = [
                            'ohda_id' => $sarf->from_ohda_id,
                            'op_type' => '-',
                            'sarf_id' => $sarf->id,
                            'last_amount' => $last_amount,
                            'amount' => $sarf->amount
                        ];
                        $op = Ohdas_operation::create($odata);
                    }
                }
            }




    }
    public function store(Request $request): RedirectResponse
    {
        foreach ($request->employees as $employee) {
           $p_dateh = Hijri::ShortDate($request->p_date);
            $input = [
                'emp_id' => $employee['emp_id'],
                'salary_year_month' => $request->salary_year_month,
                'basic_salary' => $employee['basic_salary'],

                'deductions' => $employee['deductions'],
                'deductions_purpose' => $employee['deductions_purpose'] ?? null,
                'net_salary' => $employee['net_salary'],
                'net_salary_txt' => Tafqeet::arablic($employee['net_salary']),
                'payment_type' => $request->payment_type,
                'p_date' => $request->p_date,
                'p_dateh' => $p_dateh,
            ];

            if (!empty($employee['payrolle_id'])) {

                Payroll::where('id', $employee['payrolle_id'])->update($input);
                $payroll = Payroll::find($employee['payrolle_id']);
            } else {
                $input['created_by'] = Auth::id();
                $payroll = Payroll::create($input);
            }

            if ($payroll) {
                $this->savePayroll($payroll, $request->from_ohda_id);
            }
        }

        return redirect()
            ->route('payrolls.index')
            ->with('success', 'تمت الإضافة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {


        if ($request->has('btn_add_vacation')) {


            $this->validate($request, [
                'start_date' => 'required',
                'end_date' => 'required',
                'start_dateh' => 'required',
                'end_dateh' => 'required',
                'emp_id' => 'required'
            ]);

            $input = $request->all();

            $input['created_by'] = Auth::user()->id;
            $input['no_of_days'] = abs( dateDiff($request->start_date,$request->end_date));

           // dd($input) ;

            if ($this->check_vac_dates($request->start_date, $request->end_date, $request->emp_id)) {
                if ($vaction =  Vacation::create($input)) {

                    // add Notification
                    $toUsers = User::get()->where('is_admin', 1);
                    foreach ($toUsers as $user) {
                        $n_date['user_id'] = $user->id;
                        $n_date['message'] = "تم تسجيل أجازة للموظف " .$vaction->employee->name;
                        $n_date['url'] = "employees.show" ;
                        $n_date['element_id'] = $request->emp_id ;
                        Notification::create($n_date);
                    }
                }
            } else {
                return redirect()->back()->with('danger', 'يوجد تعارض في تاريخ  الاجازة مع اجازة  أخرى');
            }
        }


        $employee = Employee::with('vacations')->find($id);
        $current_user = User::find(Auth::user()->id) ;
        return view('employees.show',compact('employee','current_user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $employee = Employee::find($id);
        $current_user = User::find(Auth::user()->id) ;
         $centers = Center::get();

        return view('employees.edit',compact( 'employee','current_user','centers'));


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
            'id_no' => 'required',
            'nationality' => 'required',
        //    'iban' => 'required',
            'job' => 'required',
            'salary' => 'required',
            'mobile_no' => 'required'

        ]);

        $input = $request->all();
        if($request->has('file'))
        {
            $uploadedFile = $request->file('file');
            $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
            $img = $uploadedFile->storeAs('uploads', $storedName, 'public');
            $input['img']= $img ;
        }

        $input['updated_by']= Auth::user()->id ;
      // dd($input) ;
        $employee =  Employee::find($id);


        $employee->update($input);


        return redirect()->route('employees.index')
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
        Employee::find($id)->delete();
        return redirect()->route('employees.index')
                        ->with('success','تم الحذف بنجاح');
    }
}
