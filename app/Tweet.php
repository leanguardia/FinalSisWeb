<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model {

    protected $fillable = ['content', 'user_id','tweet_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getTweets(){
        $tweets = Tweet::where('tweet_id', $this->id)->get();
        return $tweets;
    }

    public function getLikes(){
        $likes = Like::where('tweet_id', $this->id)->get();
        return $likes;
    }

    public function getUser(){
        $user = User::find($this->user_id);
        return $user;
    }

    public function reposts()
    {
        return $this->hasMany('App\Tweet');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function hasLikeFrom($curr_user_id)
    {
        foreach ($this->likes as $like)
        {
            if ($like->user_id == $curr_user_id)
            {
                return true;
            }
        }
        return false;
    }

    public function getRTT()
    {
        return Tweet::where('tweet_id',$this->id)->count();
    }

    public function getWriter()
    {
        $user = Tweet::find($this->tweet_id)->user;
        return $user->username;
    }

    public function getLikeId($curr_user_id)
    {
        foreach ($this->likes as $like)
        {
            if ($like->user_id == $curr_user_id)
            {
                return $like->id;
            }
        }
    }

}
