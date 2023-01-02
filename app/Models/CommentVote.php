<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentVote extends Model
{
    public $timestamps = false;

    protected $table = 'comment_vote';

    protected $fillable = [
        'is_liked'
    ];

    public function author() {
        return $this->belongsTo('App\Models\User','id_user');
    }

    public function news(){
        return $this->belongsTo('App\Models\Comment', 'id_comment');
    }
}
