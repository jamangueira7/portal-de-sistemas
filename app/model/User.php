<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    protected $fillable = ['nickname', 'email', 'name', 'password', 'login'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'users_groups', 'user_id', 'group_id');
    }

    public function favorites()
    {
        return $this->belongsToMany(Favorite::class, 'favorites', 'user_id');
    }

}
