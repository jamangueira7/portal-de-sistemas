<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\GroupsRepository;
use App\Repositories\ItemsRepository;
use App\Repositories\PagesRepository;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    public function list(ItemsRepository $repository)
    {
        try {
            $items = $repository->getAllWith();

            return view('admin.items.list', [
                'items' => $items
            ]);

        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema ao listar os Itens.",
            ]);

            return view('admin.items.list');
        }

    }

    public function ajaxGroupByPage(Request $request, PagesRepository $pagesRepository)
    {
        try {

            $page = $pagesRepository->getById($request->get('codigo'));

            return ['grupos' => $page->groups ];

        } catch (\Exception $err) {
            return ['msg' => $err->getMessage() ];
        }

    }

    public function ajaxItemsByPage(Request $request, ItemsRepository $repository)
    {
        try {
            $items = $repository->getAllByIdPage($request->get('codigo'));

            return ['items' => $items ];

        } catch (\Exception $err) {
            return ['msg' => $err->getMessage() ];
        }

    }


    public function details($id, ItemsRepository $repository, PagesRepository $pagesRepository, UsersRepository $usersRepository)
    {
        try {

            $item = $repository->getById($id);
            $pages = $pagesRepository->getAll();
            $page = $pagesRepository->getById($item['page_id']);
            $items = $repository->getAllByIdPage($item['page_id']);
            $item_groups  = $repository->getAllGroupsIDByItem($id);
            $item_users  = $repository->getAllUsersIdByItem($id);
            $users = $usersRepository->getAll();

            return view('admin.items.details', [
                'item' => $item,
                'pages' => $pages,
                'page' => $page,
                'items' => $items,
                'item_groups' => $item_groups,
                'item_users' => $item_users,
                'users' => $users ?? [],
            ]);

        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema ao ver os detalhes do Item.",
            ]);
            return view('admin.items.list');
        }

    }

    public function update(Request $request, $id, ItemsRepository $repository)
    {
        try {

            $repository->update($id, $request->all());

            session()->flash('success', [
                'success' => true,
                'messages' => "Item alterado com sucesso.",
            ]);

            return redirect()->route('admin.items.list');

        } catch (\Exception $err) {

            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema ao alterar o Item.",
            ]);
            return redirect()->route('admin.items.list');
        }

    }

    public function new(PagesRepository $repository, UsersRepository $usersRepository)
    {
        try {

            $pages = $repository->getAll();
            $users = $usersRepository->getAll();

            return view('admin.items.create', [
                'pages' => $pages,
                'users' => $users ?? [],
                'items' => [],
                'item_groups' => [],
            ]);

        } catch (\Exception $err) {

            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema ao mostrar página de cadastro do Item.",
            ]);
            return redirect()->route('admin.items.list');
        }

    }

    public function create(Request $request, ItemsRepository $repository)
    {
        try {

            $item = $repository->create($request->all());

            session()->flash('success', [
                'success' => true,
                'messages' => "Item cadastrado com sucesso.",
            ]);

            return redirect()->route('admin.items.list');

        } catch (\Exception $err) {

            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema ao cadastrar o Item.".$err->getMessage(),
            ]);

            return redirect()->route('admin.items.list');
        }

    }

    public function destroy(Request $request, $id, ItemsRepository $repository)
    {
        try {

            $item = $repository->destroy($id);

            session()->flash('success', [
                'success' => true,
                'messages' => "Item deletado com sucesso.",
            ]);

            return redirect()->route('admin.items.list');

        } catch (\Exception $err) {

            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema ao cadastrar o Item.",
            ]);

            return redirect()->route('admin.items.list');
        }

    }
}
