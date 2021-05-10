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
            $user_id = session('userID');
            if(!$user_id) {
                $pages = $repository->PagesByGroupWithUser($user_id);
            }

            return view('home.index', [
                'pages' => $pages ?? []
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
            //$res = $repository->login($request->all());

            session()->flash('success', [
                'success' => true,
                'messages' => "Você está logado.",
            ]);

            /*session([$res['key'] => $res['body']['tokenId']]);
            session(['userName' => $res['body']['userName']]);
            session(['userID' => $res['body']['userID']]);
            session(['userAccess' => $res['body']['userAccess']]);*/

            session(['iPlanetDirectoryPro' => 'adafds']);
            session(['userName' => 'Elmer Mohr IV' ]);
            session(['userID' => '2d243bf2-b28e-45dc-b686-6cb6e240500a' ]);
            session(['userAccess' => true ]);

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
        session()->forget([env('COOKIE_NAME_OPENAM'), 'userName', 'userAccess', 'userID']);

        return redirect()->route('free.index');
    }
}
