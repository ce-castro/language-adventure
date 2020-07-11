<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function __constructor(){
        $this->middleware('guest');
    }
    public function login(){
        if($user = auth()->user()){
            return back();
        } else {
            return view('sessions.login');
        }
    }

    public function loginStore(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = [
            'email' => $request['email'],
            'password' => $request['password'],
        ];

        if($request->remember == 1){
            $remember = true;
        } else {
            $remember = false;
        }

        if(auth()->attempt($credentials, $remember)){
            return redirect(route('admin'));
        } else {
            session()->flash('message_red', 'Wrong email or password');
            return redirect(route('login'));
        }

    }

    public function destroy(){
        auth()->logout();
        session()->flash('message_green', 'You have successfully logged out!');
        return redirect(route('login'));
    }
}
