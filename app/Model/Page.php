<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Page extends Model
{
    use SoftDeletes;
    use Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $fillable = ['description', 'slug'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];


    public function groups()
    {
        return $this->belongsToMany(Group::class, 'pages_groups', 'page_id', 'group_id')->withTimestamps();
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

}
