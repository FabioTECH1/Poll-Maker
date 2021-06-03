<?php

namespace App\Http\Controllers;

use App\Models\PollTitle;
use App\Models\Voter;
use Illuminate\Http\Request;

class EmailVerifyController extends Controller
{
    public function emailRequest($id)
    {

        $polls = PollTitle::where('id', $id)->count();
        if ($polls < 1) {
            abort(404);
        }
        $polls = PollTitle::where('id', $id)->where('status', 0)->get();
        //if poll have not been published
        if ($polls->count() > 0) {
            return redirect()->route('login');
        }
        $polls = PollTitle::where('id', $id)->get();
        return view('emailverify', [
            'id' => $id,
            'polls' => $polls,
        ]);
    }
    public function emailVerify($id, Request $request)
    {
        $request->validate([
            'email' => 'required | email'
        ]);
        $voterExist = Voter::where('poll_title_id', $id)->where('email', Request('email'))->get();
        if ($voterExist->count() > 0) {
            $request->session()->put('voted', ' ');
            return back()->with('emailExists', ' ');
        }
        $request->session()->put('emailVerified', Request('email'));
        $request->session()->put('poll_id', $id);
        return redirect()->route('vote.centre', $id);
    }
}