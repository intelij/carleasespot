<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, $user){
        if ($user->activation_code != '' || !$user->status || $user->type!='dealer') {
            auth()->logout();
             if($user->activation_code != '')
{
                return back()->with('warning', 'You need to activate your account. We have sent you an activation code, please check your email.');
}
else if($user->type!='dealer')
                {
                        return back()->with('warning', 'You are authorized as customer kindly login in customer Form');
                 }


            else
{
                return back()->with('warning', 'Your account has been deactivated, please contact the administrator.');
        }
        }
        return redirect()->intended($this->redirectPath());
    }

}
