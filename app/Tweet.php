<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model {

    protected $fillable = ['content', 'user_id','tweet_id'];

    function user()
    {
        return $this->belongsTo('App\User');
    }

    function reposts()
    {
        return $this->hasMany('App\Tweet');
    }

}
