<?php

namespace App\Repositories;

use App\model\Item;
use App\model\Page;
use App\model\PageGroup;
use App\model\UserGroup;

class PagesRepository {
    public function getAll()
    {
        return Page::paginate(10);
    }

    public function PagasByGroupWithUser($user_id)
    {
        $groupsByUser = UserGroup::where('user_id', $user_id)->get();
        $pages = [];
        $response = [];
        if(!empty($groupsByUser)) {
            foreach ($groupsByUser as $group) {
                $pagesGroup = PageGroup::where('group_id', $group['group_id'])->first();

                if(!in_array($pagesGroup['page_id'], $pages)) {
                    array_push($pages, $pagesGroup['page_id']);
                }

            }

            foreach ($pages as $page) {
                $response[] = Page::where('id', $page)->first();
            }
        }

        return $response;

    }

    private function makeChildrens($page_id)
    {
        $res = [];
        $fathers = Item::where('page_id', $page_id)->whereNull('father')->get();
        foreach ($fathers as $item) {
            $res[$item['id']]['father'] = $item;
            $childrens = Item::where('father', $item['id'])->get();
            if(!empty($childrens)) {
                $res[$item['id']]['children'] = $childrens;
            }

        }
        return $res;
    }


    public function getById($id)
    {
        return Page::find($id);
    }

    public function update($id, $data)
    {

        $response = Page::find($id)->update([
            'description' => $data['description'],
        ]);

        return $response;
    }

    public function create($data)
    {

        $response = Page::create([
            'description' => $data['description']
        ]);

        return $response;
    }

    public function destroy($id)
    {
        $response = Page::find($id)->delete();

        return $response;
    }
}
