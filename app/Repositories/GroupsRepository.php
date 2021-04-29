<?php

namespace App\Repositories;

use App\Model\Group;

class GroupsRepository {
    public function getAll()
    {
        return Group::all();
    }

    public function getAllWith()
    {
        return Group::paginate(10);
    }


    public function getById($id)
    {
        return Group::find($id);
    }
}
