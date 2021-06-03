<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Contracts\Service\Attribute\Required;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // email and password validations
        $request->validate([
            'email' => 'required | email',
            'password' => 'required | confirmed | min:6 | max:15'
        ]);

        //store data to database
        User::create([
            'email' => Request('email'),
            'password' => Hash::make(Request('password')),
            'number' => Request('number'),
        ]);

        //sign in
        $checkLogin = ($request->only('email', 'password'));
        Auth::attempt($checkLogin);
        return redirect()->route('home')->with('msge-2', 'Welcome');
    }
}