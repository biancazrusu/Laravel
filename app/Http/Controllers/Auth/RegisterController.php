<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\EmailToSend;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Validator;

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
    protected $redirectTo = '/home';

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
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public static function create(Request $request)
    {
        $rules = [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            // 'job'           => 'required|in_array:value1,value2', // add to .env
            'location' => 'required|min:3',
            // 'type'          => 'required|in_array:value1,value2', // add to .env
            // 'interested_in' => 'required|in_array:value1,value2', // add to .env
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            \Session::flash('registerError', true);
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        \Session::flash('registerSuccess', true);
        $activateKey = substr(md5(uniqid(rand(), true)), 16, 16);
        User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'job'               => $request->job,
            'location'          => $request->location,
            'type'              => $request->type,
            'first_name'        => $request->first_name,
            'last_name'         => $request->last_name,
            'country'           => $request->country,
            'phone_number'      => $request->phone_number,
            'interested_in'     => $request->interests,
            'subscribed'        => isset($request->allow) ? $request->allow : 0,
            'password'          => bcrypt($request->password),
            'confirmed'         => 0,
            'confirmation_code' => $activateKey,
            'user_type'         => 'user',
        ]);

        $dataEmail['email']       = $request->email;
        $dataEmail['subject']     = 'Welcome to Lori!';
        $dataEmail['name']        = $request->name;
        $dataEmail['activateKey'] = $activateKey;
        $sendEmail                = new EmailToSend();
        $sendEmail->sendEmail($dataEmail);

        return redirect()->route('frontend_index');
    }

    public function confirm($confirmation_code)
    {

        $user                    = User::where('confirmation_code', $confirmation_code)->first();
        $user->confirmed         = 1;
        $user->confirmation_code = null;
        $user->save();
        return view('frontend.pages.confirm');

    }
}
