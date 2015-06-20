<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model {

    protected $fillable = ['user_id', 'tweet_id'];

    public function user()
    {
        return $this->belongsTo('App/User');
    }

    public function getUser(){
        $user = User::find($this->user_id);
        return $user;
    }

    public function  getTweet(){
        $tweet = Tweet::find($this->tweet_id);
        return $tweet;
    }

    public function tweet()
    {
        return $this->belongsTo('App/Tweet');
    }

}
