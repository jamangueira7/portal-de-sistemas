<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\model\Item;
use App\model\Page;
use App\model\PageGroup;
use App\model\UserGroup;

class PagesRepository {
    public function getAll()
    {
        return Page::paginate(1000);
    }

    public function pagesBySlug($slug)
    {
        return Page::where('slug', $slug)->first();
    }

    public function getAllGroupsIDByPage($id)
    {
        $data = PageGroup::where('page_id', $id)->get();
        $result = [];

        foreach ($data as $page) {
            array_push($result, $page->group_id);
        }

        return $result;
    }

    public function getGroupsPage($id)
    {
        $data = PageGroup::where('page_id', $id)->get();

        return $data;
    }


    public function pagesBySlugWithChildrens($slug, $user_id)
    {
        $res = [];
        $page = Page::where('slug', $slug)->first();

        if(!$page) {
            throw new \Exception('Essa página não existe.');
        }

        $user_groups = UserGroup::where('user_id', $user_id)->get();
        $IDsPageGroups = $this->IDsGroupsByPage($page->groups);

        $groupsEmComum = $this->CheckUserGroupWithPageGroups($user_groups, $IDsPageGroups);

        if(empty($groupsEmComum)) {
            throw new \Exception('Você não tem acesso a essa página.');
        }

        $res['page'] = $page;

        $fathers = Item::where('page_id', $page['id'])->whereNull('father')->orderBy('title','ASC')->get();

        foreach ($fathers as $key=>$father) {
            if($this->CheckGroupList($father->groups, $groupsEmComum)) {
                $res['fathers'][$father['id']]['father'] = $father;
                $res['fathers'][$father['id']]['father']['childrens'] = $this->findChildrens($father['id'], $groupsEmComum, $page['id']);
            }

        }
        return $res;

    }

    private function CheckGroupList($ItemGroups,$IDsGroupsPage)
    {
        foreach ($ItemGroups as $group) {
            if(in_array($group['id'], $IDsGroupsPage)) {
                return true;
            }
        }

        return false;
    }

    private function CheckUserGroupWithPageGroups($user_groups,$IDsGroupsPage)
    {
        $comum = [];
        foreach ($user_groups as $group) {
            if(in_array($group['group_id'], $IDsGroupsPage)) {
                array_push($comum, $group['group_id']);
            }
        }

        return $comum;
    }

    private function IDsGroupsByPage($groups)
    {
        $ids = [];

        foreach ($groups as $group) {

            if(!in_array($group['id'], $ids)) {
                array_push($ids, $group['id']);
            }
        }
        return $ids;
    }

    public function findChildrens($father, $IDsGroups, $page_id)
    {
       $child = [];

        $items = Item::where('father', $father)->where('page_id', $page_id)->orderBy('title', 'asc')->get();

        foreach ($items as $key=>$item) {
            if($this->CheckGroupList($item->groups, $IDsGroups)) {
                $child[$key] = $item;
                $sons = $this->findChildrens($item['id'], $IDsGroups, $page_id);
                if($sons) {
                    $child[$key]['childrens'] = $sons;
                }
            }

        }
        return $child;
    }

    public function PagesByGroupWithUser($user_id)
    {
        $groupsByUser = UserGroup::where('user_id', $user_id)->get();

        $pages = [];

        if(!empty($groupsByUser)) {
            foreach ($groupsByUser as $group) {
                $pagesGroup = PageGroup::where('group_id', $group['group_id'])->get();

                foreach ($pagesGroup as $pg) {
                    if(!in_array($pg['page_id'], $pages) && !empty($pg['page_id'])) {
                        array_push($pages, $pg['page_id']);
                    }
                }
            }
        }
        return Page::whereIn('id', $pages)->orderBy('description', 'asc')->get();

    }

    public function getById($id)
    {
        return Page::find($id);
    }

    public function update($id, $data)
    {

        $response = Page::find($id)->update([
            'description' => $data['description'],
            'slug' => Helper::slugify($data['description']),
        ]);

        if($response) {
            $this->saveGroupPage($data['groups'], $id);
        }

        return $response;
    }

    private function saveGroupPage($groups, $page_id)
    {
        $response = PageGroup::where('page_id', $page_id)->forceDelete();

        foreach ($groups as $group) {
            PageGroup::create([
                'page_id' => $page_id,
                'group_id' => $group,
            ]);
        }
    }

    public function create($data)
    {
        $response = Page::create([
            'description' => $data['description'],
            'slug' => Helper::slugify($data['description']),
        ]);

        if($response) {
            $this->saveGroupPage($data['groups'], $response['id']);
        }

        return $response;
    }

    public function destroy($id)
    {
        $response = Page::find($id)->delete();

        return $response;
    }
}
