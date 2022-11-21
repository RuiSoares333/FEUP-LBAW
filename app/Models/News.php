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
        'reputation','title', 'content', 'picture','id_author'
    ];

    /**
     * The user this news belongs to
     */
    public function author() {
        return $this->belongsTo('App\Models\User','id_author');
    }

}
