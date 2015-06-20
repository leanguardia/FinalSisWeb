<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	protected $table = 'users';

	protected $fillable = ['name', 'last_name','email', 'password', 'username', 'picture','country_id'];

	protected $hidden = ['password', 'remember_token'];

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

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
        $tweets = $this->tweets;
        $folls = $this->following;
        foreach($folls as $fol){
            $tweets = $tweets->merge(User::find($fol->following)->tweets);
        }
        return $tweets;
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
