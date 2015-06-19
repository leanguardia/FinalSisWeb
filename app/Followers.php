<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Followers extends Model {

    protected $fillable = ['user_id', 'follower'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getFollower()
    {
        return User::find($this->follower);
    }

}