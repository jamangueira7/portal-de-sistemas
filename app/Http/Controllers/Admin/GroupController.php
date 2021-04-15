<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\GroupsRepository;
use App\Repositories\PagesRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    public function list(GroupsRepository $repository)
    {
        try {
            $val = $repository->getAll();
            return view('admin.groups.list', [
                'groups' => $val
            ]);

        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema ao listar os Grupos.",
            ]);

            return view('admin.groups.list');
        }

    }

    public function details($id, GroupsRepository $repository)
    {
        try {
            $val = $repository->getById($id);

            return view('admin.groups.details', [
                'group' => $val
            ]);

        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema ao ver os detalhes do Grupo.",
            ]);
            return view('admin.groups.list');
        }

    }
}
