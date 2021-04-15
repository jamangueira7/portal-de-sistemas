<?php

namespace App\Repositories;

use App\Model\User;

class UsersRepository {
    public function getAll()
    {
        return User::paginate(10);
    }

    public function getById($id)
    {
        return User::find($id);
    }
}
