<?php

namespace App\Http\Controllers;

use App\Models\PollTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    public function vote($poll_id, $cand_id, Request $request)
    {
        $email = $request->session()->get('emailVerified');

        //if poll have not been published
        $polls = PollTitle::where('poll_id', $poll_id)->where('status', 0)->first();
        if ($polls) {
            return redirect()->route('login');
        }

        $polls = PollTitle::where('poll_id', $poll_id)->first();
        $voter = $polls->voters()->where('email', $email)->first();

        if ($voter) {
            $request->session()->put('voted', ' ');
            $request->session()->flash('emailExists', ' ');
            return redirect()->route('get.email', $poll_id);
        }
        DB::transaction(function () use ($email, $cand_id, $poll_id) {
            $polls = PollTitle::where('poll_id', $poll_id)->first();
            $polls->voters()->create([
                'candidate_id' => $cand_id,
                'email' => $email,
            ]);
            $candidate = $polls->candidates()->where('id', $cand_id)->first();

            // count vote and store for candidate
            $polls->candidates()->where('id', $cand_id)->update([
                'vote' => $candidate->vote + 1,
            ]);

            // calculate percentage
            $polls = PollTitle::where('poll_id', $poll_id)->first();
            $totalVote =  $polls->candidates->sum('vote');
            $candidate = $polls->candidates()->where('id', $cand_id)->first();
            $percentage = ($candidate->vote / $totalVote) * 100;

            // store candidate percent
            $candidate->update([
                'percent' => $percentage,
            ]);
        });
        $request->session()->put('voted', ' ');
        return redirect()->route('poll.result', $poll_id);
    }
}