<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\model\Item;
use App\model\ItemGroup;

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

    public function getAllGroupsIDByItem($id)
    {
        $data = ItemGroup::where('item_id', $id)->get();
        $result = [];

        foreach ($data as $item) {
            array_push($result, $item->group_id);
        }

        return $result;
    }

    public function update($id, $data)
    {

        $response = Item::find($id)->update([
            'title' => $data['title'],
            'slug' => Helper::slugify($data['title']),
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
            'slug' => Helper::slugify($data['title']),
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

    public function ItemBySlug($slug)
    {
        return Item::where('slug', $slug)->first();
    }
}
