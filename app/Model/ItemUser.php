<?php

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class ItemUser extends Model
{
    protected $table = 'items_users';


    protected $fillable = ['item_id', 'user_id'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
