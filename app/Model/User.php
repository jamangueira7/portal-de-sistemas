<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class User extends Model
{
    use SoftDeletes;
    use Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $hidden = ['password'];
    protected $fillable = ['nickname', 'email', 'name', 'login', 'password'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'users_groups', 'user_id', 'group_id')->withTimestamps();
    }

    public function favorites()
    {
        return $this->belongsToMany(Favorite::class, 'favorites', 'user_id')->withTimestamps();
    }

}
