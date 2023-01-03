<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tag extends Model
{
    protected $table = 'tag';
    public $timestamps = false;

    /**
     * attributes that are mass assignable
     */

    protected $fillable = [
        'tag_name'
    ];

    public function news() {
        return $this->belongsToMany('App\Models\News', 'news_tag', 'id_tag', 'id_news');
    }

    public function followers() {
        return $this->belongsToMany('App\Models\Tag', 'tag_follow', 'id_tag', 'id_user');
    }

    public function check_follow_tag($id_user, $id_tag) {
        $follows = DB::select('select * from tag_follow where id_user = ? and id_tag = ?', [$id_user, $id_tag]);
        if ($follows == null) return false;
        else return true;
    }
    /*
    public function top_tags() {
        $followers_count = DB::table('tag_follow')->select('id_tag', DB::raw('COUNT(*) AS count'))->groupBy('id_tag');

        $top_tags = DB::table('tag')->joinSub(
            $followers_count,'$followers_count',
            function ($join) {
                $join->on('tag.id', '=', 'followers_count.id_tag');
            }
        )->orderBy('count', 'desc')->limit(4)->get();

        return $top_tags;
    }*/
}
