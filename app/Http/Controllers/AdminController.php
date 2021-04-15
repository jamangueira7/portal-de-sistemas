<?php

namespace App\Http\Controllers;

use App\Repositories\ItemsRepository;
use App\Repositories\PagesRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function list(ItemsRepository $repository)
    {
        try {
            $items = $repository->getAll();
            return view('admin.items.list', [
                'items' => $items
            ]);

        } catch (\Exception $err) {
            return view('admin.items.list');
        }

    }

    public function details($id, ItemsRepository $repository, PagesRepository $pagesRepository)
    {
        try {
            $item = $repository->getById($id);
            $pages = $pagesRepository->getAll();
            return view('admin.items.details', [
                'item' => $item,
                'pages' => $pages
            ]);

        } catch (\Exception $err) {
            return view('admin.items.list');
        }

    }

    public function update(Request $request, $id, ItemsRepository $repository)
    {
        try {
            $item = $repository->update($id, $request->all());
            return redirect()->route('admin.items.list');

        } catch (\Exception $err) {
            return view('admin.items.list');
        }

    }
}
