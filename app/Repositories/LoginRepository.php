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


        return $userData = $this->toCreateSession($res['tokenId'], $dados['login']);
    }

    public function checkLogin($token)
    {
        $data = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept-API-Version' => 'resource=1.0, protocol=1.0'
        ])->post( env('URL_CHECK_LOGIN').$token."?_action=validate")->json();

        return $data;
    }

    public function toCreateSession($tokenId, $login)
    {
        //Trazer dados do usuario no banco
        $user = User::where('login', $login)->withTrashed()->first();

        //Trazer dados do usuario da Tokio
        $userData = Http::withHeaders([
            'iPlanetDirectoryPro' => $tokenId,
            'Content-Type'     => 'application/json',
            'Accept-API-Version' => 'resource=1.2',
        ])->get( env('URL_USERDATA_OPENAM').$login)->json();

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
            'tokenId' => $tokenId,
            'userName' => $user['name'],
            'userID' => $user['id'],
            'userAccess' => $repositoryGroup->isAdmin($userData['memberOf'])
        ];

        $expiration_date = time() + 60 * 60 * 2;

        session(['iPlanetDirectoryPro' => trim($res['body']['tokenId'], '"')]);
        session(['userName' => $res['body']['userName']]);
        session(['userID' => $res['body']['userID']]);
        session(['userAccess' => $res['body']['userAccess']]);

        setrawcookie('PORTAL_COOKIE','"SITEORIGEM=42144|TIPOSITE=SISTEMAS|"', $expiration_date, '/', '.tokiomarine.com.br', false, true);
        setrawcookie('AUTH_COOKIE', trim($res['body']['tokenId'], '"'), $expiration_date, '/', '.tokiomarine.com.br', false, true);
        setrawcookie('iPlanetDirectoryPro', $res['body']['tokenId'], $expiration_date, '/', '.tokiomarine.com.br', false, true);

        return $res;
    }

    public function logout()
    {

        session()->forget([env('COOKIE_NAME_OPENAM')]);
        session()->forget(['userName']);
        session()->forget(['userAccess']);
        session()->forget(['userID']);

        setrawcookie('PORTAL_COOKIE', '', time() - 3600, '/', '.tokiomarine.com.br', false, true);
        setrawcookie('AUTH_COOKIE', '', time() - 3600, '/', '.tokiomarine.com.br', false, true);
        setrawcookie('iPlanetDirectoryPro', '', time() - 3600, '/', '.tokiomarine.com.br', false, true);

    }
}
