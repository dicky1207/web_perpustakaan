<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\AuthenticateLog;
use Carbon\Carbon;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                User::where('id', auth()->user()->id)->update(['status' => 1]);
                $this->saveUserLoginLog(auth()->user()->id, $request->getClientIp());

                $role_id = auth()->user()->role_id;
                if ($role_id === 1) {
                    return redirect()->route('admin.dashboard.index');
                } elseif ($role_id === 2) {
                    return redirect()->route('operator.dashboard.index');
                } else {
                    return redirect()->route('anggota.dashboard.index');
                }
            } else {
                $this->incrementLoginAttempts($request);
                return redirect()->back()
                    ->withInput($request->only('email', 'remember'))
                    ->withErrors(['password' => 'Password Anda salah']);
            }
        } else {
            $this->incrementLoginAttempts($request);
            return redirect()->back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors(['email' => 'Email Anda salah']);
        }
    }

    public function logout(Request $request)
    {
        User::where('id', Auth::user()->id)->update(['status' => 0]);
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }

    public function saveUserLoginLog($user_id, $last_login_ip)
    {
        $now = Carbon::now('Asia/Jakarta');
        $authenticate_log = new AuthenticateLog();
        $authenticate_log->user_id = $user_id;
        $authenticate_log->last_login_date = $now->toDateString();
        $authenticate_log->last_login_time = $now->toTimeString();
        $authenticate_log->last_login_ip = $last_login_ip;
        $authenticate_log->save();
    }
}
