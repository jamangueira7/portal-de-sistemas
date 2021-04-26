<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PagesRepository;
use App\Repositories\LoginRepository;

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

    public function login(PagesRepository $repository)
    {
        try {
            $pages = $repository->getAll();

            return view('home.tela-login', [
                'pages' => $pages
            ]);
        } catch (\Exception $err) {
            return redirect('free.index');
        }
    }

    public function authenticate(Request $request, LoginRepository $repository)
    {
        try {
            $auth = $repository->login($request->all());

            session()->flash('success', [
                'success' => true,
                'messages' => "Você está logado.",
            ]);

            return redirect()->route('free.index');
        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => $err->getMessage(),
            ]);

            return redirect()->route('free.index');
        }
    }

    public function logout()
    {
        return view('home.tela-login');
    }
}
