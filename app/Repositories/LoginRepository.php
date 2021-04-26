<?php

namespace App\Repositories;

use App\Model\User;
use Illuminate\Support\Facades\Http;

class LoginRepository {
    public function login($dados)
    {
        /*$user = User::where('login', $dados['login'])->first();

        if(empty($user)) {
            throw new \Exception('Usuario não encontrado.');
        }*/

        //Validar
        $res = Http::withHeaders([
            'X-OpenAM-Username' => $dados['login'],
            'X-OpenAM-Password' => $dados['password']
        ])->post(env('URL_AUTHENTICATION_OPENAM'));

        dd($res);
    }
}
