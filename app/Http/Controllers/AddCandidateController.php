<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Candidate;
use App\Models\PollTitle;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class AddCandidateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function createPoll(Request $request)
    {
        $request->validate([
            '*' => 'required',
        ]);
        $user = User::where('id', auth()->user()->id)->first();
        $poll_id = $request->title . random_int(10000000, 99999999);
        $poll_title = $user->poll_titles()->create([
            'title' => $request->title,
            'poll_id' => $poll_id
        ]);
        // function to create candidates
        function create_can($poll_title, $candidate)
        {
            $poll_title->candidates()->create([
                'user_id' => auth()->user()->id,
                'candidate' => $candidate,
            ]);
        }
        if ($request->can_no == 2) {
            create_can($poll_title, $request->can_1);
            create_can($poll_title, $request->can_2);
        } elseif ($request->can_no == 3) {
            create_can($poll_title, $request->can_1);
            create_can($poll_title, $request->can_2);
            create_can($poll_title, $request->can_3);
        } elseif ($request->can_no == 4) {
            create_can($poll_title, $request->can_1);
            create_can($poll_title, $request->can_2);
            create_can($poll_title, $request->can_3);
            create_can($poll_title, $request->can_4);
        }
        return redirect()->route('control', $poll_title->id);
    }

    public function destroy($poll_id)
    {
        // delete poll
        $user = User::where('id', auth()->user()->id)->first();
        $user->poll_titles()->where('id', $poll_id)->delete();
        return redirect()->route('home');
    }
}