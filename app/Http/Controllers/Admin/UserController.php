<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\GroupsRepository;

use App\Repositories\UsersRepository;
use App\Repositories\PagesRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function list(UsersRepository $repository)
    {
        try {
            $val = $repository->getAllPaginate();
            return view('admin.users.list', [
                'users' => $val
            ]);

        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema ao listar os Usuarios.",
            ]);

            return view('admin.users.list');
        }

    }

    public function details($id, UsersRepository $repository, GroupsRepository $groupsRepository)
    {
        try {
            $val = $repository->getById($id);
            $user_groups = $repository->getAllGroupsIDByUser($id);
            $groups = $groupsRepository->getAll();

            return view('admin.users.details', [
                'user' => $val,
                'groups' => $groups,
                'user_groups' => $user_groups,
            ]);

        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema ao ver os detalhes do Usuario.",
            ]);
            return view('admin.users.list');
        }

    }

    public function update(Request $request, $id, UsersRepository $repository)
    {
        try {
            $item = $repository->update($id, $request->all());

            session()->flash('success', [
                'success' => true,
                'messages' => "Usuario alterado com sucesso.",
            ]);

            return redirect()->route('admin.users.list');

        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema ao alterar o Usuario.",
            ]);
            return redirect()->route('admin.users.list');
        }

    }

    public function destroy(Request $request, $id, UsersRepository $repository)
    {

        try {
            $item = $repository->destroy($id);

            session()->flash('success', [
                'success' => true,
                'messages' => "Usuario deletado com sucesso.",
            ]);

            return redirect()->route('admin.users.list');

        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema ao remover o Usuario.",
            ]);

            return redirect()->route('admin.users.list');
        }

    }
}
