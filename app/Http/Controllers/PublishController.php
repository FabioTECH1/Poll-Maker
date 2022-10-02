<?php

namespace App\Http\Controllers;

use App\Models\PollTitle;
use App\Models\User;
use Illuminate\Http\Request;

class PublishController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function publish($poll_id)
    {
        //poll published
        $user = User::where('id', auth()->user()->id)->first();
        $t = $user->poll_titles()->where('poll_id', $poll_id)->update([
            'status' => 1
        ]);

        return back();
    }
    public function endpoll($poll_id)
    {
        //poll ended
        $user = User::where('id', auth()->user()->id)->first();
        $user->poll_titles()->where('poll_id', $poll_id)->update([
            'status' => 2
        ]);
        return back();
    }
}