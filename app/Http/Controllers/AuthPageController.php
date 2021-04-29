<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PagesRepository;

class AuthPageController extends Controller
{
    public function index($page, PagesRepository $repository)
    {

        try {
            $pages = $repository->PagesByGroupWithUser('6e9c211f-b63b-4e8e-b935-6e65fa771afd');
            $page = $repository->PagesBySlug($page);

            return view('iframe.index', [
                'page' => $page,
                'pages' => $pages
            ]);

        } catch (\Exception $err) {
            return view('home.index');
        }
    }

    public function childrens($slug, PagesRepository $repository)
    {

        try {
            $pages = $repository->PagesBySlug('$page');
            return view('home.index', [
                'pages' => $pages ?? []
            ]);
        } catch (\Exception $err) {
            return view('home.index');
        }
    }

}
