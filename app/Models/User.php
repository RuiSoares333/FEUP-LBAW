<?php

namespace App\Models;

use Auth;
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
        'username', 'email', 'password','reputation','country','picture','is_admin'
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
        return $this->hasMany('App\Models\News');
    }

    public function followed_tags() {
        $tags_followed = DB::select('select id, tag_name from (tag_follow inner join tag ON tag_follow.id_tag = tag.id) where id_user = ?',[$this->id]);
        return $tags_followed;
    }

    public function reputation() {
        if(Auth::check()) {
            $news = $this->news()->get();
            $reputation = 0;
            foreach($news as $post) {
                $reputation += $post->reputation;
            }
            return $reputation;
        }
        return 0;
    }

    public function followers() {
        return $this->belongsToMany('App\Models\User', 'follows','id2','id1')->orderBy('username');
    }

    public function following() {
        return $this->belongsToMany('App\Models\User', 'follows','id1','id2')->orderBy('username');
    }

    public function isAdmin(){
        return $this->is_admin;
    }

    public function check_follow($id1, $id2) {
        $follows = DB::select('select * from follows where id1 = ? and id2 = ?', [$id1, $id2]);
        if ($follows == null) return false;
        else return true;
    }
}
