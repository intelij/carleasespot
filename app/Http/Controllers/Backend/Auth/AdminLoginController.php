<?php

namespace App\Http\Controllers\Backend\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class AdminLoginController extends Controller
{
    protected $redirectTo = '/admin';

    public function __construct(){
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm(){
        if (auth()->guard('admin')->user()){
            return redirect()->route('admin.dashboard');
        }
        return view('backend.auth.login');
    }
    public function login(Request $request){
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
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
        Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route('admin.login'));
    }
}
