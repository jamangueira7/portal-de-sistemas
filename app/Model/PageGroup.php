<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class PageGroup extends Model
{
    protected $table = 'pages_groups';


    protected $fillable = ['page_id', 'group_id'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
