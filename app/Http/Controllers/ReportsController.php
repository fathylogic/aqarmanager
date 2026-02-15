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


class ReportsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

function payrolls_rpt(Request $request)
    {
        $current_user = User::find(Auth::user()->id) ;
        $result = null ;
        $emps = Employee::where('salary','>',0) ->get();


           if($request->has('btn_rpt') )
            {
                $year = $request->input('year', date('Y'));
                $month = str_pad($request->input('month', date('m')), 2, '0', STR_PAD_LEFT);
                $report_type = $request->input('report_type');
                $employee_filter = $request->input('employee_filter');
                $payrollQuery = Payroll::with('employee');

                if ($request->input('employee_filter') === 'specific' && $request->filled('emp_id')) {
                    $payrollQuery->where('emp_id', $request->emp_id);
                } else {
                    $payrollQuery->whereHas('employee', function ($query) {
                        $query->where('salary', '>', 0);
                    });
                }

                if ($request->input('report_type') === 'year') {
                    $payrollQuery->where('salary_year_month', 'like', $year . '/%');
                } else {
                    $payrollQuery->where('salary_year_month', $year . '/' . $month);
                }

                $result = $payrollQuery
                    ->orderBy('salary_year_month')
                    ->get();

                return view('reports.payrolls_print' , compact( 'current_user','result' , 'year' , 'month' ,'employee_filter','report_type'));

            }



       // dd($emps) ;

        return view('reports.payrolls_rpt' , compact('emps','current_user','result'));
    }

    function ohda_rpt(Request $request)
    {
        $current_user = User::find(Auth::user()->id);
        $result = null;
        $ohdas = Ohda::all();
        $selectedOhda = null;

        if ($request->has('btn_rpt')) {

            $filters = $request->only(['from_date', 'to_date', 'ohda_id']);
            $selectedOhda = Ohda::with('employee')->findOrFail($filters['ohda_id']);

            $normalizedSarfDateSql = "STR_TO_DATE(REPLACE(p_date, '/', '-'), IF(LENGTH(p_date) > 10, '%Y-%m-%d %H:%i:%s', '%Y-%m-%d'))";
            $fromDateStart = $request->filled('from_date')
                ? Carbon::parse($filters['from_date'])->startOfDay()->toDateTimeString()
                : null;
            $toDateEndOfDay = $request->filled('to_date')
                ? Carbon::parse($filters['to_date'])->endOfDay()->toDateTimeString()
                : null;

            $applySarfDateFilter = static function ($query, string $operator, string $boundary, string $normalizedSql): void {
                $query->whereHas('sarf', fn ($sarfQuery) => $sarfQuery
                    ->whereRaw("{$normalizedSql} {$operator} ?", [$boundary]));
            };

            $result = Ohdas_operation::with('ohda', 'sarf.files')
                ->where('ohda_id', $selectedOhda->id)
                ->when($fromDateStart, fn ($query) => $applySarfDateFilter($query, '>=', $fromDateStart, $normalizedSarfDateSql))
                ->when($toDateEndOfDay, fn ($query) => $applySarfDateFilter($query, '<=', $toDateEndOfDay, $normalizedSarfDateSql))
                ->orderBy(
                    Sarf::selectRaw("{$normalizedSarfDateSql}")
                        ->whereColumn('sarfs.id', 'ohdas_operations.sarf_id')
                )
                ->get();


           //  dd($result[0]->sarf->paymentType->name) ;

            return view('reports.ohda_print', [
                'current_user' => $current_user,
                'result' => $result,
                'from_date' => $filters['from_date'] ?? null,
                'to_date' => $filters['to_date'] ?? null,
                'ohda_filter' => 'specific',
                'selectedOhda' => $selectedOhda,
            ]);
        }

        return view('reports.ohda_rpt', compact('ohdas', 'current_user', 'result'));
    }


}
