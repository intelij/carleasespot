<?php

namespace App\Http\Controllers\Auth;

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
use App\Mail\ActivationMail;
use DB;
use Session;
use App\Model\States;
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
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {        
        $this->middleware('guest');
    }

    protected function signup(){
        $states_arr = States::getAllStates();
        $states = array();
        foreach($states_arr as $state){
            $states[$state->id] = $state->state;
        }
        return view('auth.register', compact('states'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone'     => 'numeric|digits:10',
            'address'   => 'string',
            'password' => 'required|string|min:6|confirmed',
            'profile_photo' => 'required|image|dimensions:max_width=300,max_height=300',
            'city'=> 'required|string',
            'state'=>'required|digits',
            'pincode'=> 'required|digits:12'
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
            'profile_photo' => 'required|image|dimensions:max_width=300,max_height=300',
            'city'=> 'required|string',
            'state'=>'required|integer',
            'pincode'=> 'required|integer'
        ]);

        try {
        
            $validatedData['password']        = bcrypt(array_get($validatedData, 'password'));
            $validatedData['activation_code'] = str_random(30).time();
            $validatedData['status'] = 0;
           $request->session()->put('email',  $validatedData['email']);
            $user                             = app(User::class)->create($validatedData);
            if (Input::file('profile_photo')->isValid()) {
               
                $file = Input::file('profile_photo');
                $filename = strtolower(str_random(50) . '.' . $file->getClientOriginalExtension());
                $file->move('assets/user_files/'.$user->uuid, $filename);
                Image::make(sprintf('assets/user_files/'.$user->uuid.'/%s', $filename))->resize(200, 200)->save();
                $user->photo= $filename;
                $user->save();
                
            }
        } catch (\Exception $exception) {
            logger()->error($exception);
            return redirect()->back()->with('message', 'Unable to create new user.');
        }
 
        $user->notify(new UserRegisteredSuccessfully($user));

    Mail::to($validatedData['email'])->bcc('sammkaranja@gmail.com')->send(new ActivationMail($validatedData));
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
        return redirect()->to('/profile')->with('success', 'Congratulations, your account has been activated successfully.');;
    }
    protected function resend_mail(Request $request)
    {
       $email=$request->session()->get('email');
        $user = app(User::class)->where('email',  $request->session()->get('email'))->first();
        if($user->status==0)
          {
            Mail::to($email)->bcc('sammkaranja@gmail.com')->send(new ActivationMail($user));
}
else
{
return redirect()->back()->with('message', 'your account is activated. Proceed to login page');
}

        return view('frontend.email.index',compact('email'));
     }
       
}
