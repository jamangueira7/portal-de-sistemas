<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $fillable = ['description'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

}
