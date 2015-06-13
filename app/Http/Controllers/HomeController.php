<?php namespace App\Http\Controllers;

use App\Tweet;
use App\User;

use Auth;

class HomeController extends Controller {

	public function index()
	{
        $users = User::all();
        if (Auth::check()) {
            $tweets = Auth::user()->ownTweetsAndFollowed();
            return view('home',compact('users','tweets'));
        }
        else {
            return view('home',compact('users'));
        }
	}

}
