<?php namespace App\Services;

use App\User;
use App\Tweet;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
            'username' => 'required|max:50|unique:users',
			'password' => 'required|confirmed|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		User::create([
			'name' => $data['name'],
            'email' => $data['email'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
			'password' => bcrypt($data['password']),
		]);
        $user = User::where('username', $data['username'])->first();
        Tweet::create(['user_id' => $user->id, 'content' => 'I joined tweeter.']);
        return $user;
	}

}
