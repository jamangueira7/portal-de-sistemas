<?php

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class ItemGroup extends Model
{
    protected $table = 'items_groups';


    protected $fillable = ['item_id', 'group_id'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
