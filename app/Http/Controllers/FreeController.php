<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PagesRepository;

class FreeController extends Controller
{
    public function index(PagesRepository $repository)
    {

        try {
            $pages = $repository->getAll();

            return view('home.index', [
                'pages' => $pages
            ]);
        } catch (\Exception $err) {
            return view('home.index');
        }
    }

    public function login()
    {
        return view('home.tela-login');
    }

    public function logout()
    {
        return view('home.tela-login');
    }
}
