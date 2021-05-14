<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\model\Favorite;
use App\model\Item;
use App\model\Page;
use Illuminate\Support\Facades\Log;


class FavoriteRepository {

    public function getFavoritesByUser($user_id)
    {

        return Favorite::where('user_id', $user_id)->get();
    }

    public function getAllFavoriteByUser($user_id, $slug, $item=false)
    {

        if($item) {
            $val = Favorite::where('user_id', $user_id)->where('slug_item', $slug)->first();
        } else {
            $val = Favorite::where('user_id', $user_id)->where('slug_page', $slug)->first();
        }

        return !empty($val) ? true : false;
    }

    public function getFavoriteBySlug($data)
    {
        $val = '';
        $item = '';
        $user_id = session('userID');

        if($data['slug_type'] == 'item') {

            $val = Item::where('slug', $data['slug_current'])->first();
            $item = $val;
            $val = Page::where('id', $item['page_id'])->first();


            $exist = Favorite::where('slug_page', Helper::slugify($val['slug']))
                ->where('slug_item', Helper::slugify($item['slug']) )
                ->where('user_id', $user_id)
                ->first();

            if(!empty($exist)) {
                return true;
            }

        } else {
            $val = Page::where('slug', $data['slug_current'])->first();

            $exist = Favorite::where('slug_page', Helper::slugify($val['slug']))
                ->whereNull('slug_item')
                ->where('user_id', $user_id)
                ->first();

            if(!empty($exist)) {
                return true;
            }
        }


        $favorite = Favorite::create([
            'description' => $data['slug_type'] == 'item' ? $item['title'] : $val['description'],
            'slug_page' => Helper::slugify($val['slug']),
            'slug_item' => !empty($item) ? Helper::slugify($item['slug']) : null,
            'user_id' => $user_id,
        ]);

        return $favorite;
    }

    public function getFavoriteDeleteBySlug($data)
    {
        $user_id = session('userID');

        if($data['slug_type'] == 'item') {
            $val = Item::where('slug', $data['slug_current'])->first();
            $item = $val;
            $val = Page::where('id', $item['page_id'])->first();

            Favorite::where('slug_page', Helper::slugify($val['slug']))
                ->where('slug_item', Helper::slugify($item['slug']) )
                ->where('user_id', $user_id)
                ->forceDelete();

        } else {
            $val = Page::where('slug', $data['slug_current'])->first();

            Favorite::where('slug_page', Helper::slugify($val['slug']))
                ->whereNull('slug_item')
                ->where('user_id', $user_id)
                ->forceDelete();
        }
        return true;
    }


}
