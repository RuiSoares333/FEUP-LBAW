<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public $timestamps = false;

    //protected $table = 'news';

    /**
     * attributes that are mass assignable
     */

    protected $fillable = [
        'reputation',
        'title',
        'content',
        'picture'
    ];

    /**
     * The user this news belongs to
     */
    public function author()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function tags() {
        return $this->belongsToMany('App\Models\Tag', 'news_tag', 'id_news', 'id_tag');
    }
}
