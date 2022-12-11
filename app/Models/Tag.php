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

}
