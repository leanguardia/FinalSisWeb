<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Following extends Model {

    protected $fillable = ['user_id', 'following'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getFollowing()
    {
        return User::find($this->following);
    }

}
