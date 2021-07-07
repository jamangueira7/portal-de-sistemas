<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\FavoriteRepository;

use App\Repositories\GroupsRepository;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class ResponsibleController extends Controller
{
    public function list(UsersRepository $repository)
    {
        try {
            $val = $repository->getAllWithItemsResponsiblePaginate();
            return view('admin.responsible.list', [
                'users' => $val
            ]);

        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema ao listar os Usuarios.",
            ]);

            return view('admin.responsible.list');
        }

    }

    public function details($id, UsersRepository $repository)
    {
        try {
            $val = $repository->getById($id);

            return view('admin.responsible.details', [
                'user' => $val,
            ]);

        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema ao ver os detalhes do Usuario.",
            ]);
            return view('admin.responsible.list');
        }

    }
}
