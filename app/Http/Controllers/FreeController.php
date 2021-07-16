<?php

namespace App\Http\Controllers;

use App\model\Favorite;
use App\Repositories\FavoriteRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use App\Repositories\PagesRepository;
use App\Repositories\LoginRepository;

class FreeController extends Controller
{
    public function index(PagesRepository $repository, FavoriteRepository $favoriteRepository, LoginRepository $login)
    {
        try {
            $user_id = session('userID');

            if($user_id) {
                $pages = $repository->PagesByGroupWithUser($user_id);
                $favorites = $favoriteRepository->getFavoritesByUser($user_id);
            }

            return view('home.index', [
                'pages' => $pages ?? [],
                'favorites' => $favorites ?? [],
            ]);

        } catch (\Exception $err) {
            return view('home.index');
        }
    }

    public function login()
    {
        try {

            return view('home.tela-login', [
                'pages' =>  []
            ]);
        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => $err->getMessage(),
            ]);

            return redirect()->route('free.index');
        }
    }

    public function authenticate(Request $request, Response $response, LoginRepository $repository)
    {
        try {
            //$res = $repository->login($request->all());

            session()->flash('success', [
                'success' => true,
                'messages' => "Você está logado.",
            ]);


            session(['iPlanetDirectoryPro' => 'adafds']);
            session(['userName' => 'Elmer Mohr IV' ]);
            session(['userID' => '10f50b4e-f4a5-4698-bd66-6e8a20ff761d' ]);
            session(['userAccess' => true ]);
            session(['PORTAL_COOKIE' => "SITEORIGEM=42144|TIPOSITE=SISTEMAS|"]);


            return redirect()->route('free.index');

        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => $err->getMessage(),
            ]);

            return redirect()->route('free.index');
        }
    }

    public function logout(LoginRepository $repository)
    {

        $repository->logout();

        return redirect()->route('free.index');
    }
}
