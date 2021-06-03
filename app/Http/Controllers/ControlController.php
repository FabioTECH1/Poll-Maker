<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\PollTitle;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControlController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only('index');
    }
    public function index($id, Request $request)
    {
        $polls = PollTitle::where('id', $id)->where('user_id', $request->user()->id)->get();
        $request->session()->put('voted', ' ');
        return view('control', [
            "polls" => $polls,
        ]);
    }
    public function voteCentre($id, Request $request)
    {
        if (!session('emailVerified')) {
            return redirect()->route('get.email', $id);
        }
        $polls = PollTitle::where('id', $id)->get();
        return view('vote-centre', [
            "polls" => $polls,
        ]);
    }
}