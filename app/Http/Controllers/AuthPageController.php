<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PagesRepository;
use App\Repositories\ItemsRepository;

class AuthPageController extends Controller
{
    public function index($page, $item, PagesRepository $repository, ItemsRepository $Itemsrepository)
    {
        try {
            $pagesBygroup = $repository->PagesByGroupWithUser('6e9c211f-b63b-4e8e-b935-6e65fa771afd');
            $pageBySlug = $repository->PagesBySlug($page);

            if(isset($item)) {
                $current = $Itemsrepository->ItemBySlug($item);
            } else {
                $current = $pageBySlug;
            }

            return view('iframe.index', [
                'page' => $pageBySlug,
                'pages' => $pagesBygroup,
                'current' => $current,
            ]);

        } catch (\Exception $err) {
            return view('home.index');
        }
    }
}
