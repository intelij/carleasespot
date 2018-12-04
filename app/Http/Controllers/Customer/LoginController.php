<?php

namespace App\Http\Controllers\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
class LoginController extends Controller
{
    protected $redirectTo = '/customer';

    public function __construct(){
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm(){
        if (auth()->guard('api')->user()){
            return redirect('/customer');
        }
        return view('customer.login');
    }
    public function login(Request $request){
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
       
$user=DB::table('users')->where('email', $request->email)->first();
          if ($user->activation_code != '' || !$user->status || $user->type!='customer') {

            auth()->logout();
             if($user->activation_code != '')
            {
                return redirect()->back()->with('warning', 'You need to activate your account. We have sent you an activation code, please check your email.');
           }
            else if($user->type!='customer')
                {
                  
                        return back()->with('warning', 'You are authorized as dealer kindly login in dealer login Form');
                 }


            else
          {
                
                return back()->with('warning', 'Your account has been deactivated, please contact the administrator.');
        }
        }  
        if (Auth::guard('api')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

        
            if ($request->ajax()) {
          
                return response()->json(['success'=>true], 200);
            }else {
                return redirect()->back()->withInput($request->only('email', 'remember'));
            }
        }
        $errors = ['login_response' => trans('auth.failed')];
        if ($request->ajax()) {
            return response()->json($errors, 422);
        }else {
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors(['email' => trans('auth.failed')]);
        }
    }
    public function postLogout(Request $request){
        Auth::guard('api')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route('customer.login'));
    }
    public function authenticated(Request $request, $user){
      
        if ($user->activation_code != '' || !$user->status || $user->type!='customer') {
 
            auth()->logout();
             if($user->activation_code != '')
            {
                return back()->with('warning', 'You need to activate your account. We have sent you an activation code, please check your email.');die;
           }
            else if($user->type!='customer')
                {
                        return back()->with('warning', 'You are authorized as dealer kindly login in dealer login Form');die;
                 }


            else
          {
                return back()->with('warning', 'Your account has been deactivated, please contact the administrator.');die;
        }
        }
        return redirect()->intended($this->redirectPath());
    }

}

