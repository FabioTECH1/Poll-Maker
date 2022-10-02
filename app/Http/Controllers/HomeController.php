<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('home');
    }
    public function candidateNo(Request $request)
    {
        $request->validate([
            'candidate_no' => 'required | numeric',
        ]);
        if ($request->candidate_no < 2 || $request->candidate_no > 4) {
            return back()->with('msge-3', 'Candidates no. must be between 2 to 4');
        }
        if ($request->candidate_no == 2) {
            return back()->with('can', 2);
        } elseif ($request->candidate_no == 3) {
            return back()->with('can', 3);
        } else {
            return back()->with('can', 4);
        }
    }
}