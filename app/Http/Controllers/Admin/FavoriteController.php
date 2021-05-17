<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\FavoriteRepository;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class FavoriteController extends Controller
{
    public function ajaxAlterFavorite(Request $request, FavoriteRepository $repository)
    {
        try {
            if($request->get('delete') == 'delete') {

                $favorites = $repository->getFavoriteDeleteBySlug($request->all());
            } else {
                $favorites = $repository->getFavoriteBySlug($request->all());
            }

            return ['favorites' => $favorites ];

        } catch (\Exception $err) {
            return ['msg' => $err->getMessage() ];
        }
    }
}
