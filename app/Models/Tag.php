<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
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

    public function news_tags() {
        return $this->belongsToMany('App\Models\User', 'news_tag', 'id_news', 'id_tag');
    }

    public function top_tags() {
        
    }
}
