<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'page_id'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function users()
    {
        return $this->hasMany(User::class, 'user_id');
    }

    public function pages()
    {
        return $this->hasMany(Page::class, 'page_id');
    }
}
