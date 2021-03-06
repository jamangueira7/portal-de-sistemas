<?php

namespace App\Repositories;

use App\model\Group;
use App\model\UserGroup;

class GroupsRepository {
    public function getAll()
    {
        return Group::orderBy('description', 'ASC')->get();
    }

    public function getAllWith()
    {
        return Group::paginate(1000);
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

            $groupExist = Group::where('description', strtoupper($group_name[1]))->first();

            if(empty($groupExist)) {
                $group_new = Group::create([
                    'description' => strtoupper($group_name[1])
                ]);

                UserGroup::create([
                    'user_id' => $user_id,
                    'group_id' => $group_new['id'],
                ]);
            } else {
                $user_group = UserGroup::where('user_id', $user_id)
                    ->where('group_id', $groupExist['id'])
                    ->first();

                if(empty($user_group)) {
                    UserGroup::create([
                        'user_id' => $user_id,
                        'group_id' => $groupExist['id'],
                    ]);
                }
            }


        }
    }

    public function isAdmin($groups)
    {
        foreach ($groups as $group) {
            $aux = explode(",", $group);
            $group_name = explode("=", $aux[0]);
            if($group_name[1] == 'SGS_PORTAL_SISTEMAS_ADMINISTRADORES') {
                return true;
            }
        }

        return false;
    }

    public function create($data)
    {
        $groupExists = Group::where('description', $data['description'])->first();

        if(!empty($groupExists)) {
            throw new \Exception('Esse grupo já existe.');
        }


        $response = Group::create([
            'description' => $data['description'],
        ]);

        return $response;
    }
}
