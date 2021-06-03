<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\PollTitle;
use App\Models\Voter;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Percentage;

class ResultController extends Controller
{
    public function index($id)
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

        $polls = PollTitle::where('id', $id)->where('status', 2)->get();
        $maxVote = Candidate::where('poll_title_id', $id)->max('percent');

        if (session('voted') || $polls->count() > 0) {
            $polls = PollTitle::where('id', $id)->get();
            $votersNo = Voter::where('poll_title_id', $id)->count();

            return view('result', [
                'polls' => $polls,
                'votersNo' => $votersNo,
                'maxVote' => $maxVote,
            ]);
        }
        return redirect()->route('get.email', $id);
    }
}