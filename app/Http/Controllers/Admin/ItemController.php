<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ItemsRepository;
use App\Repositories\PagesRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

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

    public function details($id, ItemsRepository $repository, PagesRepository $pagesRepository)
    {
        try {
            $item = $repository->getById($id);
            $pages = $pagesRepository->getAll();
            $items = $repository->getAll();
            return view('admin.items.details', [
                'item' => $item,
                'pages' => $pages,
                'items' => $items,
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
            $item = $repository->update($id, $request->all());

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

    public function new(PagesRepository $repository)
    {
        try {
            $pages = $repository->getAll();
            return view('admin.items.create', [
                'pages' => $pages
            ]);

        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema ao mostrar pagina de cadastro do Item.",
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
                'messages' => "Aconteceu algum problema ao cadastrar o Item.",
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
