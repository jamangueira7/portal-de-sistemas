<?php

namespace App\Http\Controllers;

use App\Repositories\ItemsRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function list(ItemsRepository $repository)
    {
        try {
            $items = $repository->getAll();
            return view('admin.itens-menu.listar-itens', [
                'items' => $items
            ]);

        } catch (\Exception $err) {
            return view('admin.itens-menu.listar-itens');
        }

    }
}
