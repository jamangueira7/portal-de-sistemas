<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function list()
    {
        return view('admin.itens-menu.listar-itens');
    }
}
