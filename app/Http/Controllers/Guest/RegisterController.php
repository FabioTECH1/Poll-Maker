<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Mail\verifymail;
use App\Models\User;
use App\Models\verify_user;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    public function index()
    {
        return view('guest.register');
    }

    public function store(Request $request)
    {
        // email and password validations
        $request->validate([
            'fname' => 'required | string ',
            'mname' => 'string',
            'lname' => 'required | string ',
            'email' => 'required | email ',
            'password' => 'required | confirmed | min:6 | max:15'
        ]);

        //check if user with the email already exist
        $usercount = User::where('email', $request->email)->first();
        if ($usercount) {
            return back()->with('msg-4', ' ');
        }

        //store data to database
        $user = User::create([
            'email' => $request->email,
            'fname' => ucwords($request->fname),
            'mname' => ucwords($request->mname),
            'lname' => ucwords($request->lname),
            'password' => Hash::make($request->password),
        ]);

        // to verify user
        $user->verifyuser()->create([
            'token' => Str::random(60),
        ]);
        Mail::to($request->email)->send(new verifymail($user));
        return redirect()->route('login')->with('msg-5', ' ');
    }


    public function verifymail($user_id, $token)
    {
        $check = verify_user::where('token', $token)->where('user_id', $user_id)->first();
        // check if user with the token exists
        if ($check) {
            $user = User::where('id', $user_id)->first();
            // check if user is verified
            if ($user->email_verified_at === null) {
                $user->update([
                    'email_verified_at' => Carbon::now(),
                ]);
                $check->delete();
                return redirect()->route('login')->with('msg-6', ' ');
            } else {
                return redirect()->route('login')->with('msg-7', ' ');
            }
        } else {
            return response(null, 409);
        }
    }
}
