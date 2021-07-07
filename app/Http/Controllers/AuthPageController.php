<?php

namespace App\Http\Controllers;

use App\Repositories\FavoriteRepository;
use Illuminate\Http\Request;
use App\Repositories\PagesRepository;
use App\Repositories\ItemsRepository;

class AuthPageController extends Controller
{
    public function index($page, $item=null, PagesRepository $repository, ItemsRepository $Itemsrepository, FavoriteRepository $favoriteRepository)
    {
        try {
            $user_id = session('userID');
            if(!$user_id) {
                throw new \Exception('Você não está logado.');
            }

            $pagesBygroup = $repository->PagesByGroupWithUser($user_id);
            $pageBySlug = $repository->PagesBySlugWithChildrens($page, $user_id);


            if(isset($item)) {
                $current = $Itemsrepository->ItemBySlug($page, $item);
                $favorite = $favoriteRepository->getAllFavoriteByUser($user_id, $page, $current['slug']);
            } else {
                $favorite = $favoriteRepository->getAllFavoriteByUser($user_id, $pageBySlug['page']['slug']);
            }

            if(!isset($pageBySlug['fathers'])) {
                throw new \Exception('Você não deu permissões aos itens dessa página ou não tem itens cadastrados.');

            }

            return view('iframe.index', [
                'page' => $pageBySlug,
                'pages' => $pagesBygroup,
                'current' => $current ?? null,
                'favorite' => $favorite,
            ]);

        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => $err->getMessage(),
            ]);

            return redirect()->route('free.index');
        }
    }
}
