<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'last_name','email', 'password', 'username'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    public function tweets(){
        return $this->hasMany('App\Tweet');
    }

    public function followers(){
        return $this->hasMany('App\Followers');
    }

    public function following(){
        return $this->hasMany('App\Following');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }

    public function ownTweetsAndFollowed()
    {
        return $tweets = $this->tweets ;
    }

    public function hasRetwitted($tweet_id)
    {
        foreach ($this->tweets as $tweet)
        {
            if ($tweet->tweet_id== $tweet_id)
            {
                return true;
            }
        }
        return false;
    }
}
