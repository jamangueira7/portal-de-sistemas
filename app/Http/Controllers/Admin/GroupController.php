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
            $val = $repository->getAllWith();

            return view('admin.groups.list', [
                'groups' => $val ?? []
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

    public function new()
    {
        try {
            return view('admin.groups.create');

        } catch (\Exception $err) {

            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema ao mostrar página de cadastro do Grupos.",
            ]);
            return redirect()->route('admin.groups.list');
        }

    }

    public function create(Request $request, GroupsRepository $repository)
    {
        try {

            $repository->create($request->all());

            session()->flash('success', [
                'success' => true,
                'messages' => "Grupo cadastrado com sucesso.",
            ]);

            return redirect()->route('admin.groups.list');

        } catch (\Exception $err) {

            session()->flash('error', [
                'error' => true,
                'messages' => $err->getMessage(),
            ]);

            return redirect()->route('admin.groups.list');
        }

    }
}
