<?php

namespace App\Http\Controllers;

use App\Models\PollTitle;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $checkpoll = PollTitle::get();

        return view('home', ['checkpoll' => $checkpoll]);
    }
    public function candidateNo(Request $request)
    {
        $request->validate([
            'candidate-no' => 'required | numeric',
        ]);
        if (Request('candidate-no') < 2 || Request('candidate-no') > 4) {
            return back()->with('msge-3', 'Candidates no. must be between 2 to 4');
        }
        if (Request('candidate-no') == 2) {
            return back()->with('2-can', ' ');
        } elseif (Request('candidate-no') == 3) {
            return back()->with('3-can', ' ');
        } else {
            return back()->with('4-can', ' ');
        }
    }
}