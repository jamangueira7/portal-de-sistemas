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
            $pageBySlug = $repository->PagesBySlugWithChildrens($page, $user_id);

            if(isset($item)) {
                $current = $Itemsrepository->ItemBySlug($item);
            }

            if(!isset($pageBySlug['fathers'])) {
                throw new \Exception('Você não deu permissões aos itens dessa pagina ou não tem itens cadastrados.');

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

            return redirect()->route('free.index');
        }
    }
}
