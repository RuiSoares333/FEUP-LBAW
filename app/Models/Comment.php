<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false;

    //protected $table = 'comment';

    /**
     * attributes that are mass assignable
     */

    protected $fillable = [
        'content'
    ];

    /**
     * The user this news belongs to
     */
    public function author() {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function fromNews(){
        return $this->belongsTo('App\Models\News', 'id_news');
    }

    public function fromComment(){
        return $this->belongsTo('App\Models\Comment', 'id_comment');
    }

}
