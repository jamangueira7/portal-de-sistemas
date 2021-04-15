<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Group extends Model
{
    use SoftDeletes;
    use Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $fillable = ['description'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_groups', 'group_id', 'user_id');
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
