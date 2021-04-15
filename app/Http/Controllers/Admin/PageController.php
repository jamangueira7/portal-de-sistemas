<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\PagesRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function list(PagesRepository $repository)
    {
        try {
            $val = $repository->getAll();
            return view('admin.pages.list', [
                'pages' => $val
            ]);

        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema ao listar as Paginas.",
            ]);

            return view('admin.pages.list');
        }

    }

    public function details($id, PagesRepository $repository)
    {
        try {
            $val = $repository->getById($id);
            return view('admin.pages.details', [
                'page' => $val
            ]);

        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema ao ver os detalhes do Pagina.",
            ]);
            return view('admin.pages.list');
        }

    }

    public function update(Request $request, $id, PagesRepository $repository)
    {
        try {
            $item = $repository->update($id, $request->all());

            session()->flash('success', [
                'success' => true,
                'messages' => "Pagina alterada com sucesso.",
            ]);

            return redirect()->route('admin.pages.list');

        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema ao alterar a Pagina.",
            ]);
            return redirect()->route('admin.pages.list');
        }

    }

    public function new(PagesRepository $repository)
    {
        try {
            $pages = $repository->getAll();
            return view('admin.pages.create', [
                'pages' => $pages
            ]);

        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema ao mostrar pagina de cadastro do Paginas.",
            ]);
            return redirect()->route('admin.pages.list');
        }

    }

    public function create(Request $request, PagesRepository $repository)
    {
        try {
            $item = $repository->create($request->all());

            session()->flash('success', [
                'success' => true,
                'messages' => "Pagina cadastrada com sucesso.",
            ]);

            return redirect()->route('admin.pages.list');

        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema ao cadastrar a Pagina.",
            ]);

            return redirect()->route('admin.pages.list');
        }

    }

    public function destroy(Request $request, $id, PagesRepository $repository)
    {

        try {
            $item = $repository->destroy($id);

            session()->flash('success', [
                'success' => true,
                'messages' => "Pagina deletada com sucesso.",
            ]);

            return redirect()->route('admin.pages.list');

        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema ao excluir a pagina.",
            ]);

            return redirect()->route('admin.pages.list');
        }

    }
}
