<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Favorite extends Model
{
    use SoftDeletes;
    use Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $fillable = ['description', 'user_id', 'slug_page', 'slug_item', 'favorite'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function users()
    {
        return $this->hasMany(User::class, 'user_id');
    }
}
