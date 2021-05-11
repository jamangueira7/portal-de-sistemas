<?php

namespace App\Repositories;

use App\model\User;
use App\model\UserGroup;


class UsersRepository {
    public function getAll()
    {
        return User::paginate(1000);
    }

    public function getById($id)
    {
        $model = User::find($id);

        return User::find($id);
    }

    public function getAllGroupsIDByUser($user_id)
    {
        $data = UserGroup::where('user_id', $user_id)->get();
        $result = [];

        foreach ($data as $group) {
            array_push($result, $group->group_id);
        }

        return $result;
    }

    public function update($id, $data)
    {

        $response = User::find($id)->update([
            'name' => $data['name']
        ]);


        if($response) {
            $this->saveGroupByUser($data['groups'], $id);
        }


        return $response;
    }

    private function saveGroupByUser($groups, $user_id)
    {
        $response = UserGroup::where('user_id', $user_id)->forceDelete();

        foreach ($groups as $group) {
            UserGroup::create([
                'user_id' => $user_id,
                'group_id' => $group,
            ]);


        }
    }

    public function create($data)
    {

        $response = User::create([
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'name' => $data['name'],
            'login' => $data['login'],
            'password' => $data['password'],
        ]);

        return $response;
    }

    public function destroy($id)
    {
        $response = User::find($id)->delete();

        return $response;
    }
}
