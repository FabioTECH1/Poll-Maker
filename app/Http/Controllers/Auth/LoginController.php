<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // email and password validations
        $request->validate([
            'email' => 'required | email',
            'password' => 'required | min:6 | max:15'
        ]);
        //Check credentials to log in user
        $checkLogin = ($request->only('email', 'password'));

        if (Auth::attempt($checkLogin)) {
            return redirect()->route('home')->with('msge-2', 'Welcome');
        } else
            // starts a flash session and returns a message for unregisstered users
            return back()->with('msge-1', 'Invalid login details');
    }
    public function logout(Request $request)
    {
        // log user out
        Auth::logout();
        return redirect('/');
    }
}