<?php

namespace App\Repositories;

use App\Model\Group;
use App\Model\UserGroup;

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

    public function saveGroupsByUser($user_id, $groups)
    {
        foreach ($groups as $group) {
            $aux = explode(",", $group);
            $group_name = explode("=", $aux[0]);

            $groupExist = Group::where('description', strtoupper($group_name[1]));

            if(empty($groupExist)) {
                $group_new = Group::create([
                    'description' => strtoupper($group_name[1])
                ]);

                UserGroup::create([
                    'user_id' => $user_id,
                    'group_id' => $group_new['id'],
                ]);
            }


        }
    }
}
