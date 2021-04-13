<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    protected $fillable = ['description'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
