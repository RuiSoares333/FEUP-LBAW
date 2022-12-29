<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function followers() {
        return $this->belongsToMany('App\Models\User', 'tag_follow','id_user','id_tag')->orderBy('tag_name');
    }

    public function news() {
        return $this->belongsToMany('App\Models\News', 'news_tag', 'id_news', 'id_tag');
    }

    public function top_tags() {
        $followers_count = DB::table('tag_follow')->select('id_tag', DB::raw('COUNT(*) AS count'))->groupBy('id_tag');

        $top_tags = DB::table('tag')->joinSub(
            $followers_count,'$followers_count',
            function ($join) {
                $join->on('tag.id', '=', 'followers_count.id_tag');
            }
        )->orderBy('count', 'desc')->limit(5)->get();

        return $top_tags;
    }
}
