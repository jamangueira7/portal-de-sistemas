<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PagesRepository;
use App\Repositories\ItemsRepository;

class AuthPageController extends Controller
{
    public function index($page, $item=null, PagesRepository $repository, ItemsRepository $Itemsrepository)
    {
        try {
            $user_id = session('userID');
            if(!$user_id) {
                throw new \Exception('Você não está logado.');
            }

            $pagesBygroup = $repository->PagesByGroupWithUser($user_id);
            $pageBySlug = $repository->PagesBySlugWithChildrens($page);

            if(isset($item)) {
                $current = $Itemsrepository->ItemBySlug($item);
            }

            return view('iframe.index', [
                'page' => $pageBySlug,
                'pages' => $pagesBygroup,
                'current' => $current ?? null,
            ]);

        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => $err->getMessage(),
            ]);

            return view('home.index');
        }
    }
}
