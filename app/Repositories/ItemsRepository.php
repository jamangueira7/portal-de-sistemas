<?php

namespace App\Repositories;

use App\model\Item;

class ItemsRepository {
    public function getAll()
    {
        return Item::all();
    }

    public function getAllWith()
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
            'father' => $data['father'] == -1 ? null : $data['father'],
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

    public function destroy($id)
    {
        $response = Item::find($id)->delete();

        return $response;
    }
}
