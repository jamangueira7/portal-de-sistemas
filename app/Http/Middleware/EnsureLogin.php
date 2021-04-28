<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

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

        if($router[0] == 'admin' && !isset(session('COOKIE_NAME_OPENAM')['tokenId']) && !session('userAccess')) {
            session()->flash('error', [
                'error' => true,
                'messages' => 'Você não tem permissão para acessar essa area.',
            ]);

            return redirect()->route('free.index');
        }

        return $next($request);
    }
}
