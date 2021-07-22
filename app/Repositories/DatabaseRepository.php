<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\model\Favorite;
use App\model\Group;
use App\model\Item;
use App\model\ItemGroup;
use App\model\ItemUser;
use App\model\Page;
use App\model\PageGroup;
use App\model\UserGroup;
use App\model\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DatabaseRepository {
    public function listDatabase()
    {
        $path = Storage::disk('backup')->allFiles();
        $count = count($path);

        return array_slice($path, $count-5, $count);
    }

    public function destroy($name)
    {
        $path = Storage::disk('backup')->delete($name);
    }

    public function reset()
    {
        DB::table('items_users')->delete();
        DB::table('users_groups')->delete();
        DB::table('pages_groups')->delete();
        DB::table('items_groups')->delete();
        DB::table('favorites')->delete();
        DB::table('users')->delete();
        DB::table('groups')->delete();
        DB::table('items')->delete();
        DB::table('pages')->delete();
    }

    public function create($file)
    {
        $part = explode('.', $file->getClientOriginalName())[1];
        if( $part!= 'json') {
            throw new \Exception('Arquivo precisa ser JSON.', 1155);
        }

        if(Storage::disk('backup')->exists($file->getClientOriginalName())) {
            throw new \Exception('Já existe um backup desse dia. Antes de prosseguir exclua o arquivo.', 1155);
        }

        $path = Storage::putFileAs('backup', $file, $file->getClientOriginalName());
    }


    public function generate()
    {
        $file_name = date("d-m-Y") . ".json";

        $exists = Storage::disk('backup')->exists($file_name);

        if($exists) {
            throw new \Exception('Já foi criado um backup do dia de hj. Procure o arquivo na lista e apague antes de gerar outro.', 1155);
        }
        $file = [];

        $file['users'] = User::all();
        $file['groups'] = Group::all();
        $file['items'] = Item::all();
        $file['pages'] = Page::all();
        $file['favorites'] = Favorite::all();
        $file['users_groups'] = UserGroup::all();
        $file['items_users'] = ItemUser::all();
        $file['items_groups'] = ItemGroup::all();
        $file['pages_groups'] = PageGroup::all();


        $path = Storage::disk('backup')->put($file_name, json_encode($file));

        return $path;
    }

    public function useFile($name)
    {
        $pieces = explode(".", $name);

        if($pieces[1] !== 'json'){
            throw new \Exception('O arquivo precisa ser JSON', 1156);
        }

        $file = Storage::disk('backup')->get($name);
        $fileArray = json_decode($file, true);

        $fileTranslation = [];


       //users
        foreach ($fileArray['users'] as $user) {
            $current  = User::create($user);
            $fileTranslation['users'][$user['id']] = $current['id'];
        }

        //groups
        foreach ($fileArray['groups'] as $group) {
            $current  = Group::create($group);
            $fileTranslation['groups'][$group['id']] = $current['id'];
        }

        //pages
        foreach ($fileArray['pages'] as $page) {
            $current  = Page::create($page);
            $fileTranslation['pages'][$page['id']] = $current['id'];
        }

        //items
        foreach ($fileArray['items'] as $item) {
            $current  = Item::create([
                'title' => $item['title'],
                'slug' => $item['slug'],
                'father' => $item['father'],
                'url' => $item['url'],
                'page_id' => $fileTranslation['pages'][$item['page_id']],
                'new_tab' => $item['new_tab'],
            ]);
            $fileTranslation['items'][$item['id']] = $current['id'];
        }


        //favorites
        foreach ($fileArray['favorites'] as $favorite) {

            $current  = Favorite::create([
                'user_id' => $fileTranslation['users'][$favorite['user_id']],
                'slug_page' => $favorite['slug_page'],
                'description' => $favorite['description'],
                'slug_item' => $favorite['slug_item'],
            ]);
            $fileTranslation['favorites'][$favorite['id']] = $current['id'];
        }

        //users_groups
        foreach ($fileArray['users_groups'] as $user_group) {
            $current  = UserGroup::create([
                'user_id' => $fileTranslation['users'][$user_group['user_id']],
                'group_id' => $fileTranslation['groups'][$user_group['group_id']],
            ]);
        }

        //items_users
        foreach ($fileArray['items_users'] as $key=>$item_user) {

            $current  = ItemUser::create([
                'item_id' => $fileTranslation['items'][$item_user['item_id']],
                'user_id' => $fileTranslation['users'][$item_user['user_id']],
            ]);
        }

        //items_groups
        foreach ($fileArray['items_groups'] as $item_group) {
            $current  = ItemGroup::create([
                'item_id' => $fileTranslation['items'][$item_group['item_id']],
                'group_id' => $fileTranslation['groups'][$item_group['group_id']],
            ]);
        }

        //items_groups
        foreach ($fileArray['pages_groups'] as $page_group) {
            $current  = PageGroup::create([
                'page_id' => $fileTranslation['pages'][$page_group['page_id']],
                'group_id' => $fileTranslation['groups'][$page_group['group_id']],
            ]);
        }
    }

}
