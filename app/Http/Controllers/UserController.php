<?php

namespace App\Http\Controllers;

use App\Helpers\EmailToSend;
use App\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::first();
        return view('backend.pages.user', ['currentUser' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('backend.pages.create_user', ['currentUser' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'          => 'required|max:255',
            'email'         => 'required|email|max:255',
            'password'      => 'required|min:6',
            'job'           => 'required|max:255',
            'location'      => 'required|min:3',
            'type'          => 'required|max:255',
            'interested_in' => 'required|max:255',
            'first_name'    => 'required|max:255',
            'last_name'     => 'required|max:255',
            'country'       => 'required|max:255',
            'phone_number'  => 'required|max:255',
        ];

        $activateKey = substr(md5(uniqid(rand(), true)), 16, 16);
        $validator   = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user                    = new User();
        $user->name              = $request->name;
        $user->password          = bcrypt($request->password);
        $user->email             = $request->email;
        $user->job               = $request->job;
        $user->location          = $request->location;
        $user->type              = $request->type;
        $user->interested_in     = $request->interested_in;
        $user->first_name        = $request->first_name;
        $user->last_name         = $request->last_name;
        $user->country           = $request->country;
        $user->phone_number      = $request->phone_number;
        $user->confirmed         = 0;
        $user->confirmation_code = $activateKey;
        $user->subscribed        = isset($request->status) ? 1 : 0;
        $user->user_type         = isset($request->user_type) ? 'admin' : 'user';

        $dataEmail['email']       = $request->email;
        $dataEmail['subject']     = 'Welcome to Lori!';
        $dataEmail['name']        = $request->name;
        $dataEmail['activateKey'] = $activateKey;
        $sendEmail                = new EmailToSend();
        $sendEmail->sendEmail($dataEmail);

        try {
            $user->save();
        } catch (\Exception $e) {
            \Session::flash('exceptions', [$e->getMessage()]);
            return redirect()->back()->withInput();
        }
        \Session::flash('success', ['User successfully created.']);
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('backend.pages.user', ['currentUser' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public static function update(Request $request, User $user)
    {
        $rules = [
            'name'          => 'required|max:255',
            'email'         => 'required|email|max:255',
            'job'           => 'required|max:255',
            'location'      => 'required|min:3',
            'type'          => 'required|max:255',
            'interested_in' => 'required|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();

        }

        $user->name          = $request->name;
        $user->email         = $request->email;
        $user->job           = $request->job;
        $user->location      = $request->location;
        $user->type          = $request->type;
        $user->interested_in = $request->interested_in;
        $user->first_name    = $request->first_name;
        $user->last_name     = $request->last_name;
        $user->country       = $request->country;
        $user->phone_number  = $request->phone_number;
        $user->subscribed    = isset($request->status) ? 1 : 0;


        if ($request->form == 'backend') {
            $user->user_type = isset($request->user_type) ? 'admin' : 'user';
        }
        try {
            $user->save();
        } catch (\Exception $e) {
            \Session::flash('exceptions', [$e->getMessage()]);
            return redirect()->back()->withInput();
        }

        if ($request->form == 'backend') {
            \Session::flash('success', ['User successfully updated']);
            return redirect()->route('users.index');
        } else {
            return redirect()->route('frontend_index');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
        } catch (\Exception $e) {
            \Session::flash('exceptions', [$e->getMessage()]);
            return redirect()->back()->withInput();
        }
        \Session::flash('success', ['User successfully deleted']);
        return redirect()->route('users.index');
    }

}
