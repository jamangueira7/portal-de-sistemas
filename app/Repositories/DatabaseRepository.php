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
use App\User;
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


}
