<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsVote extends Model
{
    public $timestamps = false;

    protected $table = 'news_vote';

    protected $fillable = [
        'is_liked'
    ];

    public function author() {
        return $this->belongsTo('App\Models\User','id_user');
    }

    public function news(){
        return $this->belongsTo('App\Models\News', 'id_news');
    }
}
