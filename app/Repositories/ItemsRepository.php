<?php

namespace App\Repositories;

use App\Model\Item;

class ItemsRepository {
    public function getAll()
    {
        return Item::paginate(10);
    }

    public function getById($id)
    {
        return Item::find($id);
    }

    public function update($id, $data)
    {

        $response = Item::find($id)->update([
            'title' => $data['title'],
            'father' => null,
            'url' => $data['url'],
            'page_id' => $data['page'],
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
}
