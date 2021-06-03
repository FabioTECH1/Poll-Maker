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
    public function can2(Request $request, PollTitle $title)
    {
        $request->validate([
            'title' => 'required',
            'can-1' => 'required',
            'can-2' => 'required',
        ]);
        $title->create([
            'user_id' => $request->user()->id,
            'title' => Request('title'),
        ]);
        $polltitles = PollTitle::where('title', Request("title"))->where('user_id', $request->user()->id)->get();
        foreach ($polltitles as $polltitle) {
            $polltitle = $polltitle->id;
        }
        Candidate::create([
            'user_id' => $request->user()->id,
            'candidate' => Request('can-1'),
            'poll_title_id' => $polltitle,
        ]);
        Candidate::create([
            'user_id' => $request->user()->id,
            'candidate' => Request('can-2'),
            'poll_title_id' => $polltitle,

        ]);
        return redirect()->route('control', $polltitle);
    }
    public function can3(Request $request, PollTitle $title)
    {
        $request->validate([
            'title' => 'required',
            'can-1' => 'required',
            'can-2' => 'required',
            'can-3' => 'required',

        ]);
        $title->create([
            'user_id' => $request->user()->id,
            'title' => Request('title'),
        ]);
        $polltitles = PollTitle::where('title', Request("title"))->where('user_id', $request->user()->id)->get();
        foreach ($polltitles as $polltitle) {
            $polltitle = $polltitle->id;
        }

        Candidate::create([
            'user_id' => $request->user()->id,
            'candidate' => Request('can-1'),
            'poll_title_id' => $polltitle,
        ]);
        Candidate::create([
            'user_id' => $request->user()->id,
            'candidate' => Request('can-2'),
            'poll_title_id' => $polltitle,

        ]);
        Candidate::create([
            'user_id' => $request->user()->id,
            'candidate' => Request('can-3'),
            'poll_title_id' => $polltitle,
        ]);
        return redirect()->route('control', $polltitle);
    }
    public function can4(Request $request, PollTitle $title)
    {
        $request->validate([
            'title' => 'required',
            'can-1' => 'required',
            'can-2' => 'required',
            'can-3' => 'required',
            'can-4' => 'required',
        ]);
        $title->create([
            'user_id' => $request->user()->id,
            'title' => Request('title'),
        ]);
        $polltitles = PollTitle::where('title', Request("title"))->where('user_id', $request->user()->id)->get();
        foreach ($polltitles as $polltitle) {
            $polltitle = $polltitle->id;
        }
        Candidate::create([
            'user_id' => $request->user()->id,
            'candidate' => Request('can-1'),
            'poll_title_id' => $polltitle,
        ]);
        Candidate::create([
            'user_id' => $request->user()->id,
            'candidate' => Request('can-2'),
            'poll_title_id' => $polltitle,

        ]);
        Candidate::create([
            'user_id' => $request->user()->id,
            'candidate' => Request('can-3'),
            'poll_title_id' => $polltitle,
        ]);
        Candidate::create([
            'user_id' => $request->user()->id,
            'candidate' => Request('can-4'),
            'poll_title_id' => $polltitle,
        ]);
        return redirect()->route('control', $polltitle);
    }
    public function destroy($id, Request $request)
    {
        PollTitle::where('id', $id)->where('user_id', $request->user()->id)->delete();
        return redirect()->route('home');
    }
}