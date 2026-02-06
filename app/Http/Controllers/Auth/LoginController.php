<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Carbon\Carbon;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\PaymentController;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';
    protected function redirectTo()
    {
        return '/home'; // أي مسار تريده
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    protected function authenticated(Request $request, $user)
    {
        $afterSevenDays = \Carbon\Carbon::today()->addDays(7);

        $payments_un_payed = \App\Models\Payment::where('status', 0)
            ->whereDate('p_date', '<=', $afterSevenDays)
            ->count();

        if ($payments_un_payed > 0) {

            $pc = new PaymentController() ;
            $pc->send_late_payments();
            session()->put('show_login_alert', true);
        }
    }



}
