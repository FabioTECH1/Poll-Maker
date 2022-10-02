<?php

namespace App\Http\Controllers;

use App\Models\PollTitle;
use Illuminate\Http\Request;

class EmailVerifyController extends Controller
{
    public function emailRequest($poll_id)
    {
        $polls = PollTitle::where('poll_id', $poll_id)->first();
        if (!$polls) {
            return view('errors.404');
        }
        //if poll have not been published
        $polls = PollTitle::where('poll_id', $poll_id)->where('status', 0)->first();
        if ($polls) {
            return redirect()->route('login');
        }
        $polls = PollTitle::where('poll_id', $poll_id)->get();
        return view('emailverify', [
            'polls' => $polls,
        ]);
    }
    public function emailVerify($poll_id, Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);
        $polls = PollTitle::where('poll_id', $poll_id)->first();
        $voter = $polls->voters()->where('email', $request->email)->first();
        if ($voter) {
            $request->session()->put('voted', ' ');
            return back()->with('emailExists', ' ');
        }
        $request->session()->put('emailVerified', $request->email);
        return redirect()->route('vote.centre', [$poll_id, $request->email]);
    }
}