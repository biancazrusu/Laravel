<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\User;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public static function changePassword(Request $request){
        $user = Auth::user();
        if (password_verify($request->oldPass, $user->password)){
            if($request->password == $request->password_confirmation){
                $user->password = password_hash($request->password, PASSWORD_BCRYPT);
                $user->save();
                $status = 1; //OK
            }else {
                $status = 2; //"The passwords doesn't match"
            }
        }else{
            $status = 3; //"Wrong old password!"
        }

        return $status;
    }
}
