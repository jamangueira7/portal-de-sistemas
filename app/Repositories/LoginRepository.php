<?php

namespace App\Repositories;

use App\model\User;
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
            'Content-Type'     => 'application/json',
            'Accept-API-Version' => 'resource=1.2',
        ])->get( env('URL_USERDATA_OPENAM').$dados['login'])->json();



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

        $res['body'] = [
            'tokenId' => $res['tokenId'],
            'userName' => $user['name'],
            'userID' => $user['id'],
            'userAccess' => $repositoryGroup->isAdmin($userData['memberOf'])
        ];

        $expiration_date = time() + 60 * 60 * 2;

        setrawcookie('PORTAL_COOKIE','"SITEORIGEM=42144|TIPOSITE=SISTEMAS|"', $expiration_date, '/', '.tokiomarine.com.br', false, true);
        setrawcookie('AUTH_COOKIE', trim($res['body']['tokenId'], '"'), $expiration_date, '/', '.tokiomarine.com.br', false, true);
        setrawcookie('iPlanetDirectoryPro', $res['tokenId'], $expiration_date, '/', '.tokiomarine.com.br', false, true);

        return $res;

    }

    public function logout()
    {
        setrawcookie('PORTAL_COOKIE', '', time() - 3600, '/', '.tokiomarine.com.br', false, true);
        setrawcookie('AUTH_COOKIE', '', time() - 3600, '/', '.tokiomarine.com.br', false, true);
        setrawcookie('iPlanetDirectoryPro', '', time() - 3600, '/', '.tokiomarine.com.br', false, true);

    }
}
