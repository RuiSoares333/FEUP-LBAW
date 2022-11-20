<?php

namespace App\Models;

use Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','reputation','country','picture','isAdmin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The news this user owns.
     */
    public function news() {
        return $this->hasMany('App\Models\News','user_id');
    }

    public function reputation() {
        $news = Auth::user()->news()->get();
        $reputation = 0;
        foreach($news as $post) {
            $reputation += $post->reputation;
        }
        return $reputation;
    }

    public function followers() {
        return $this->belongsToMany('App\Models\User', 'follows','id2','id1')->orderBy('username');
    }

    public function following() {
        return $this->belongsToMany('App\Models\User', 'follows','id1','id2')->orderBy('username');
    }
}
