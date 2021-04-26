<?php

namespace App\Repositories;

use App\Model\User;
use Illuminate\Support\Facades\Http;


class LoginRepository {
    public function login($dados)
    {
        //Validar
        $res = Http::withHeaders([
            'X-OpenAM-Username' => $dados['login'],
            'X-OpenAM-Password' => $dados['password']
        ])->post(env('URL_AUTHENTICATION_OPENAM'))->json();


        if(isset($res['code']) && $res['code'] === 401) {
            throw new \Exception('Usuario não encontrado.');
        }


        //Trazer dados do usuario no banco
        $user = User::where('login', $dados['login'])->withTrashed()->first();

        //Trazer dados do usuario da Tokio
        $userData = Http::withHeaders([
            'iPlanetDirectoryPro' => $res['tokenId'],
        ])->get(env('URL_USERDATA_OPENAM').$dados['login'])->json();

        if(empty($user)) {
            $repository = new UsersRepository();

            $user = $repository->create([
                'nickname' => $userData['username'],
                'email' => $userData['mail'][0],
                'name' => $userData['name'][0],
                'login' => $userData['username']
            ]);
        }elseif(!empty($user['deleted_at'])) {
            $user->restore();
        }

        //gravar grupos
        $repositoryGroup = new GroupsRepository();
        $repositoryGroup->saveGroupsByUser($user['id'], $userData['memberOf']);


        cookie(env('COOKIE_NAME_OPENAM'), [
            'tokenId' => $res['tokenId'],
            'user' => $user['name'],
            'email' => $user['email'],
        ], 1140);
    }
}
