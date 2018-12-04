<?php

namespace App\Http\Controllers\Customer;

use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;
use App\Notifications\UserRegisteredSuccessfully;
use Illuminate\Http\Request;
use Image;
use Mail;
use App\Mail\Customer;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/customer';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
	protected function signup()
    {
		return view('customer.signup');
	}
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone'     => 'numeric|digits:10',
            'address'   => 'string',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Entities\User
     */
    protected function register(Request $request)
    {
        /** @var User $user */
        $validatedData = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'phone'     => 'numeric|digits:10',
            'address'   => 'string',
            'password'  => 'required|string|min:6|confirmed',
        ]);
	
        try {
            $validatedData['password']        = bcrypt(array_get($validatedData, 'password'));
            $validatedData['activation_code'] = str_random(30).time();
            $validatedData['status'] = 0;
			$validatedData['type']='customer';
            $user                             = app(User::class)->create($validatedData);
				
                $user->save();
            }
			catch (\Exception $exception) {
            logger()->error($exception);
            return redirect()->back()->with('message', 'Unable to create new user.');
        }
        //$user->notify(new UserRegisteredSuccessfully($user));
        Mail::to($validatedData['email'])->bcc('sammkaranja@gmail.com')->send(new Customer($validatedData));
  $request->session()->put('email',  $validatedData['email']);
$email=$validatedData['email'];
        return view('frontend.email.index',compact('email'));
    }
     /**
     * Activate the user with given activation code.
     * @param string $activationCode
     * @return string
     */
    public function activateUser(string $activationCode)
    {
        try {
            $user = app(User::class)->where('activation_code', $activationCode)->first();
            if (!$user) {
                return "The code does not exist for any user in our system.";
            }
            $user->status          = 1;
            $user->activation_code = null;
            $user->save();
            auth()->login($user);
        } catch (\Exception $exception) {
            logger()->error($exception);
            return "Whoops! something went wrong.";
        }
        return redirect()->to('/customer')->with('success', 'Congratulations, your account has been activated successfully.');;
    }
}
