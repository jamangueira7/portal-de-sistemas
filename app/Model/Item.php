<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Item extends Model
{
    use SoftDeletes;
    use Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $fillable = ['title', 'father', 'url', 'page_id', 'slug', 'new_tab'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'items_groups', 'item_id', 'group_id');
    }
}
