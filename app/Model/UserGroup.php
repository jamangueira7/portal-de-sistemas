<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    protected $table = 'users_groups';


    protected $fillable = ['user_id', 'group_id'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
