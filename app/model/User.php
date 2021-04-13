<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    protected $fillable = ['nickname', 'email', 'name', 'email', 'password', 'login'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

}
