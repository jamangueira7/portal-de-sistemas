<?php

namespace App\Http\Controllers;

use App\model\Favorite;
use App\Repositories\FavoriteRepository;
use Illuminate\Http\Request;
use App\Repositories\PagesRepository;
use App\Repositories\LoginRepository;

class FreeController extends Controller
{
    public function index(PagesRepository $repository, FavoriteRepository $favoriteRepository)
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

    public function login(PagesRepository $repository)
    {
        try {
            $pages = $repository->getAll();

            return view('home.tela-login', [
                'pages' => $pages ?? []
            ]);
        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => $err->getMessage(),
            ]);

            return redirect()->route('free.index');
        }
    }

    public function authenticate(Request $request, LoginRepository $repository)
    {
        try {
            $res = $repository->login($request->all());

            session()->flash('success', [
                'success' => true,
                'messages' => "Você está logado.",
            ]);

            session([$res['key'] => $res['body']['tokenId']]);
            session(['userName' => $res['body']['userName']]);
            session(['userID' => $res['body']['userID']]);
            session(['userAccess' => $res['body']['userAccess']]);
            session(['PORTAL_COOKIE' => "SITEORIGEM=42144|TIPOSITE=SISTEMAS|"]);

            /*session(['iPlanetDirectoryPro' => 'adafds']);
            session(['userName' => 'Elmer Mohr IV' ]);
            session(['userID' => 'c9f48a76-6834-4585-97a6-f0e4f5007de2' ]);
            session(['userAccess' => true ]);
            session(['PORTAL_COOKIE' => "SITEORIGEM=42144|TIPOSITE=SISTEMAS|"]);*/


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
        session()->forget([env('COOKIE_NAME_OPENAM'), 'userName', 'userAccess', 'userID', 'PORTAL_COOKIE']);

        return redirect()->route('free.index');
    }
}
