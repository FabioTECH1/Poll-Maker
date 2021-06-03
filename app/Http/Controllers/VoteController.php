<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\PollTitle;
use App\Models\Voter;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function vote($id, Request $request)
    {
        $poll_id = $request->session()->get('poll_id');
        $email = $request->session()->get('emailVerified');

        $polls = PollTitle::where('id', $poll_id)->where('status', 0)->get();
        //if poll have not been published
        if ($polls->count() > 0) {
            return redirect()->route('login');
        }

        $voterMail = Voter::where('email', $email)->where('poll_title_id', $poll_id)->get();
        if ($voterMail->count() > 0) {
            $request->session()->put('voted', ' ');
            $request->session()->flash('emailExists', ' ');
            return redirect()->route('get.email', $poll_id);
        }
        Voter::create([
            'candidate_id' => $id,
            'email' => $request->session()->get('emailVerified'),
            'poll_title_id' => $poll_id,
        ]);
        $candidates = Candidate::where('poll_title_id', $poll_id)->where('id', $id)->get();
        // count vote and dtore for candidate
        foreach ($candidates as $votecount) {
            $voteupdate = $votecount->vote;
            Candidate::where('poll_title_id', $poll_id)->where('id', $id)->update([
                'vote' => ($voteupdate + 1),
            ]);
        }

        $totalVote = Candidate::where('poll_title_id', $poll_id)->sum('vote');
        $candidates = Candidate::where('poll_title_id', $poll_id)->get();
        foreach ($candidates as $candidate) {
            //calc candidate vote percentage
            $percentage = ($candidate->vote / $totalVote) * 100;
            // store candidate percent
            Candidate::where('poll_title_id', $poll_id)->where('id', $candidate->id)->update([
                'percent' => $percentage,
            ]);
        }
        $request->session()->put('voted', ' ');
        return redirect()->route('poll.result', $poll_id);
    }
}