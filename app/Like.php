<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model {

    protected $fillable = ['user_id', 'tweet_id'];

    public function user()
    {
        return $this->belongsTo('App/User');
    }

    public function tweet()
    {
        return $this->belongsTo('App/Tweet');
    }

}
