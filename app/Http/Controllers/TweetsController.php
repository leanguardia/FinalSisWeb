<?php namespace App\Http\Controllers;

use App\Tweet;
//use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;
use Auth;

class TweetsController extends Controller {

    public function retweet(Request $request){
        $input = $request::all();
        Tweet::create($input);
        $username = Tweet::find($input['tweet_id'])->user->username;
        $count = Tweet::where("tweet_id", $input['tweet_id'])->count();
        return $count;
    }

    public function reply(Request $request){
        $input = $request::all();
        Tweet::create($input);
        return redirect('/'.Auth::user()->username);
        return $input;
    }

	public function store(Request $request)
	{
        $input = $request::all();
        Tweet::create($input);
        return $input;
	}

	public function show($id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}

}
