<?php namespace App\Http\Controllers;

use App\Followers;
use App\Following;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;

class FollowersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        //
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($username, Request $request)
	{
        $input = $request::all();
        Followers::create($input);
        Following::create(['user_id' => $input['follower'], 'following' => $input['user_id']]);
        return redirect('/'.$username);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($username, Request $request)
    {
        $input = $request::all();
        Followers::where('follower', (string)$input['follower'])->where('user_id', (string)$input['user_id'])->first()->delete();
        Following::where('following', (string)$input['user_id'])->where('user_id', (string)$input['follower'])->first()->delete();
        return redirect('/'.$username);
    }

}
