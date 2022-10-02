<?php

namespace App\Http\Controllers;

use App\Models\PollTitle;
use App\Models\User;
use Illuminate\Http\Request;

class ControlController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only('index');
    }
    public function index($poll_id, Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $polls = $user->poll_titles()->where('poll_id', $poll_id)->get();
        $request->session()->put('voted', ' ');
        return view('control', [
            "polls" => $polls,
        ]);
    }
    public function voteCentre($poll_id)
    {
        if (!session('emailVerified')) {
            return redirect()->route('get.email', $poll_id);
        }
        $polls = PollTitle::where('poll_id', $poll_id)->get();
        return view('vote-centre', [
            "polls" => $polls,
        ]);
    }
}