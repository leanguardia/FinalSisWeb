<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;
use App\Like;

class LikesController extends Controller {

    public function store(Request $request)
    {
        $input = $request::all();
        Like::create($input);
        return redirect('/home');
    }

    public function destroy($id)
    {
        Like::destroy($id);
        return redirect('/home');
    }
}
