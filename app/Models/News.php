<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public $timestamps = false;

    /**
     * attributes that are mass assignable
     */

    protected $fillable = [
        'id', 'reputation', 'title', 'content', 'picture'
    ];

    /**
     * The user this news belongs to
     */
    public function author() {
        return $this->belongsTo('App\Models\User');
    }


}
