<?php namespace App\Http\Controllers;

use App\Tweet;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;

class TweetsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
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
