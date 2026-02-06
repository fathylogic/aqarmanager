<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use app\models\User ;
use Illuminate\Http\Request;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Center;
use App\Models\Maincenter;
use App\Models\Location;
use App\Models\Unit;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today = Carbon::today();
        $afterSevenDays = Carbon::today()->addDays(7);

        $payments_un_payed = Payment::where('status', 0)
            ->whereDate('p_date', '<=', $afterSevenDays)
            ->count();


//==========================email=================================================
//  ارسال ميل بدون مرفقات
        /*
$to = ['fathylogic@gmail.com', 'fathylogic@hotmail.com'] ;
        send_mail(
            $to,
            'مرحباً بك',
            '<h2>تم إنشاء حسابك بنجاح</h2><p>شكراً لاستخدامك النظام</p>',
            true
        );
*/
// ارسال ميل بالمرفقات
        /*
        send_mail(
            $to,
            'عقد الإيجار',
            '<p>مرفق عقد الإيجار</p>',
            true,
            [
                storage_path('app/contracts/contract.pdf'),
                [
                    'path' => storage_path('app/invoice.pdf'),
                    'name' => 'فاتورة.pdf'
                ]
            ]
        );
*/
//===========================================================================
        $current_user = User::find(Auth::user()->id) ;
        $centers = Maincenter::with('centers')->get();
        return view('home', compact('current_user','centers'));
    }

    public function showAlert()
    {
        if (session()->has('show_login_alert')) {
            session()->forget('show_login_alert');

            return response()->json([
                'show_alert' => true,
                'message' => 'يوجد دفعات واجبة التحصيل',
                'url' => route('payments.get_late_payments')
            ]);
        }

        return response()->json(['show_alert' => false]);
    }

}
