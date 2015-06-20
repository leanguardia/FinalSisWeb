<?php namespace App\Http\Controllers;

use App\User;
use App\Tweet;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class UsersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Auth::check()){
            $user = Auth::user();
            $tweets = $user->tweets()->get()->reverse();
            return view('users.show')->with(['user' => $user, 'tweets' => $tweets]);
        }
        else{
            return view('auth.login');
        }
	}

	public function show($username)
	{
		$user = User::where('username', $username)->first();
        if(!$user->tweets){
            Tweet::creat(['user_id' => $user->id, 'content' => 'I just register for tweeter.']);
        }
        $tweets = $user->tweets;
        return view('users.show')->with(['user' => $user, 'tweets' => $tweets]);
	}

    public function followers($username)
    {
        $user = User::where('username',$username)->first();
        return view('users.followers',compact('user'));
    }

    public function following($username)
    {
        $user = User::where('username',$username)->first();
        return view('users.following',compact('user'));
    }

	public function edit($id)
	{
		//
	}

	public function update($id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}

}
