<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'father', 'url', 'page_id'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
