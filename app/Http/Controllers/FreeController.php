<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FreeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function login()
    {
        return view('home.tela-login');
    }

    public function logout()
    {
        return view('home.tela-login');
    }
}
