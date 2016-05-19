<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests;

class AuthController extends Controller
{

    public function getSignup()
    {
        return view('auth.signup');
    }

    public function postSignup(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users|email|max:255',
            'username' => 'required|unique:users|alpha_dash|max:20',
            'password' => 'required|min:6'
        ]);

        User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect('/')->with('info', 'Your account has been created');
    }

    public function getSignin()
    {
        return view('auth.signin');
    }

    public function postSignin()
    {
        
    }
}
