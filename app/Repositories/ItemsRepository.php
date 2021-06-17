<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\model\Item;
use App\model\ItemGroup;
use App\model\ItemUser;
use App\model\Page;

class ItemsRepository {
    public function getAll()
    {
        return Item::all();
    }

    public function getAllWith()
    {
        return Item::paginate(1500);
    }

    public function getAllByIdPage($page_id)
    {
        $items = Item::where('page_id', $page_id)->get();
        $res = [];

        foreach ($items as $key =>$item) {
            $res[$key]['id'] = $item['id'];
            $res[$key]['title'] = $this->mountFree($item);
        }

        return json_decode(json_encode($res), FALSE);
    }


    private function mountFree($item, $rec=0)
    {
        $res = "";
        if($rec == 0) {
            $page = Page::where('id', $item['page_id'])->first();
            $res .= $page['description'] . " / ";

            $res .= $this->mountFree($item, 1);

        } else {
            if(!empty($item['father'])) {
                $itemRec = Item::where('id', $item['father'])->first();

                $val = $this->mountFree($itemRec, 1);

                $res .= $val. " / ".$item['title'];
            } else {
                $res .= $item['title'];
            }

        }


        return $res;
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

    public function getAllUsersIdByItem($id)
    {
        $data = ItemUser::where('item_id', $id)->get();
        $result = [];

        foreach ($data as $item) {
            array_push($result, $item->user_id);
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
            'new_tab' => isset($data['new_tab']) ? true : false,
        ]);

        if($response) {
            $data['groups'] = isset($data['groups']) ? $data['groups'] : [];
            $data['users'] = isset($data['users']) ? $data['users'] : [];

            $this->saveGroupByItem($data['groups'], $id);
            $this->saveUsersByItem($data['users'], $id);
        }

        return $response;
    }

    private function saveGroupByItem($groups, $item_id)
    {
        $response = ItemGroup::where('item_id', $item_id)->forceDelete();

        if(!empty($groups)) {
            foreach ($groups as $group) {
                ItemGroup::create([
                    'item_id' => $item_id,
                    'group_id' => $group,
                ]);
            }
        }

    }

    private function saveUsersByItem($users, $item_id)
    {
        $response = ItemUser::where('item_id', $item_id)->forceDelete();

        if(!empty($users)) {
            foreach ($users as $users) {
                ItemUser::create([
                    'item_id' => $item_id,
                    'user_id' => $users,
                ]);
            }
        }

    }

    public function create($data)
    {

        $response = Item::create([
            'title' => $data['title'],
            'slug' => Helper::slugify($data['title']),
            'father' => $data['father'] == -1 ? null : $data['father'],
            'url' => $data['url'],
            'page_id' => $data['page'],
            'new_tab' => isset($data['new_tab']) ? true : false,
        ]);

        if($response) {
            $data['groups'] = isset($data['groups']) ? $data['groups'] : [];
            $data['users'] = isset($data['users']) ? $data['users'] : [];

            $this->saveGroupByItem($data['groups'], $response['id']);
            $this->saveUsersByItem($data['users'], $response['id']);
        }



        return $response;
    }

    public function destroy($id)
    {
        $response = Item::find($id)->delete();

        return $response;
    }

    public function ItemBySlug($page, $slug)
    {
        $pages = Page::where('slug', $page)->get();
        foreach ($pages as $page) {
            $item = Item::where('slug', $slug)->where('page_id', $page['id'])->first();
            if(!empty($item)) {
                return $item;
            }
        }
    }
}
