<?php namespace App\Http\Controllers;

use App\Tweet;
use App\User;

use Auth;

class HomeController extends Controller {

	public function index()
	{
        $users = User::all();
        $user = user::all()->first();
        $words = Tweet::mostFrequent();
        $p = Tweet::where('promote',true)->get();
        $proms = array();
        foreach ($p as $pro) {
            if($pro->country_id==Auth::user()->country_id)
                array_push($proms, $pro);
        }

        if (Auth::check()) {
            $tweets = Auth::user()->ownTweetsAndFollowed();
            return view('home',compact('users','tweets','words','proms'));
        }
        else {
            return view('home',compact('users','words','user','proms'));
        }
	}

}
