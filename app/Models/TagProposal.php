<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsVote extends Model
{
    public $timestamps = false;

    protected $table = 'tag_proposal';

    protected $fillable = [
        'tag_name',
        'description'
    ];
}
