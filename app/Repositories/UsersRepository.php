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
        $model = User::find($id);

        return User::find($id);
    }

    public function update($id, $data)
    {

        $response = User::find($id)->update([
            'name' => $data['name']
        ]);

        return $response;
    }

    public function create($data)
    {

        $response = Item::create([
            'title' => $data['title'],
            'father' => null,
            'url' => $data['url'],
            'page_id' => $data['page'],
        ]);

        return $response;
    }

    public function destroy($id)
    {
        $response = User::find($id)->delete();

        return $response;
    }
}
