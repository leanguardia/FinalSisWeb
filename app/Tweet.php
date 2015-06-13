<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model {

    protected $fillable = ['content', 'user_id','tweet_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
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

}
