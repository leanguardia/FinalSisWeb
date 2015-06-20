<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
//use Request;
use App\User;
use App\Tweet;

class SearchsController extends Controller {

	public function results(Request $request)
    {
        $text = $request->input('text');
        $users = User::where('username','LIKE','%'.$text.'%')->get();
        $tweets = Tweet::where('content','LIKE','%'.$text.'%')->get();
        return view('search',compact('users','tweets'));
    }
}
