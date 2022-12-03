<?php

namespace App\Http\Controllers;

use App\Http\Requests\TweetStoreRequest;
use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function index()
    {
        $tweets = auth()->user()->timeline();
        return view('tweets.index',compact('tweets'));
    }

    public function store(TweetStoreRequest $request)
    {
        Tweet::create([
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return redirect()->route('home');
    }
}
