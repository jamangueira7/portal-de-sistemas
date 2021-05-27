<?php

namespace App\Http\Middleware;

use App\Repositories\LoginRepository;
use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

class EnsureLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $router = explode("/", Route::getCurrentRoute()->uri);

        if(isset($_COOKIE['iPlanetDirectoryPro']) && !session('userAccess')) {
            $respostitory = new LoginRepository();

            $data = $respostitory->checkLogin($_COOKIE['iPlanetDirectoryPro']);

            if(!isset($data['uid'])) {
                session()->flash('error', [
                    'error' => true,
                    'messages' => 'Não conseguimos fazer seu login automatico.',
                ]);
            } else {
                $res = $respostitory->toCreateSession($_COOKIE['iPlanetDirectoryPro'], $data['uid']);

                session()->flash('success', [
                    'success' => true,
                    'messages' => "Você está logado.",
                ]);


                session(['iPlanetDirectoryPro' => trim($res['body']['tokenId'], '"')]);
                session(['userName' => $res['body']['userName']]);
                session(['userID' => $res['body']['userID']]);
                session(['userAccess' => $res['body']['userAccess']]);
            }
        }

        if($router[0] == 'admin' && !isset(session('COOKIE_NAME_OPENAM')['tokenId']) && !session('userAccess')) {
            session()->flash('error', [
                'error' => true,
                'messages' => 'Você não tem permissão para acessar essa area.',
            ]);

            return redirect()->route('free.index');
        }


        if($router[0] == 'login' && isset(session('COOKIE_NAME_OPENAM')['tokenId']) && session('userAccess')) {
            session()->flash('error', [
                'error' => true,
                'messages' => 'Você já está logado.',
            ]);

            return redirect()->route('free.index');
        }

        return $next($request);
    }
}
