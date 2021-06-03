<?php

namespace App\Http\Controllers;

use App\Models\PollTitle;
use Illuminate\Http\Request;

class Pub_EndController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function publish($id, Request $request)
    {
        PollTitle::where('id', $id)->update([
            'status' => 1
            //poll published
        ]);
        return back();
    }
    public function endpoll($id, Request $request)
    {
        PollTitle::where('id', $id)->update([
            'status' => 2
            //poll ended
        ]);
        return back();
    }
}