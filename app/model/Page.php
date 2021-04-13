<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $fillable = ['description'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];


    public function groups()
    {
        return $this->belongsToMany(Group::class, 'users_groups', 'page_id', 'group_id');
    }

    public function itens()
    {
        return $this->hasMany(Item::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Favorite::class, 'favorites', 'page_id');
    }
}
