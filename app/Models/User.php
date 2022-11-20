<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
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
        $news_reputation = DB::table('news')->where('user_id')->lists('reputation');
        foreach($news_reputation as $post_reputation) {
            $reputation += $post_reputation;
        }
        return $reputation;
    }

    public function followers() {
        return $this->belongsToMany('follows','id2','id1');
    }

    public function following() {
        return $this->belongsToMany('follows','id1','id2');
    }

}
