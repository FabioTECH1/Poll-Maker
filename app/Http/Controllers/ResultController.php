<?php

namespace App\Http\Controllers;

use App\Models\PollTitle;


class ResultController extends Controller
{
    public function index($poll_id)
    {
        //poll removed
        $polls = PollTitle::where('poll_id', $poll_id)->get();
        if ($polls->count() < 1) {
            return view('errors.404');
        }

        //if poll have not been published
        $polls = PollTitle::where('poll_id', $poll_id)->where('status', 0)->first();
        if ($polls) {
            return redirect()->route('login');
        }

        // polls published
        $polls = PollTitle::where('poll_id', $poll_id)->where('status', 1)->first();
        $maxVote = $polls->candidates->max('percent');

        if (session('voted') || $polls) {
            $votersNo = $polls->voters()->count();
            $polls = PollTitle::where('poll_id', $poll_id)->get();

            return view('result', [
                'polls' => $polls,
                'votersNo' => $votersNo,
                'maxVote' => $maxVote,
            ]);
        }
        return redirect()->route('get.email', $poll_id);
    }
}