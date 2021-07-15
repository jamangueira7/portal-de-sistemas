<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\DatabaseRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class DatabaseController extends Controller
{
    public function index(DatabaseRepository $repository)
    {
        try {
            $items = $repository->listDatabase();

            return view('admin.database.details', [
                'data' => $items
            ]);

        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema na página de administração de banco de dados.",
            ]);

            return redirect()->route('admin.items.list');
        }

    }

    public function use($name, DatabaseRepository $repository)
    {
        try {
            $items = $repository->useFile($name);

            session()->flash('success', [
                'success' => true,
                'messages' => "Arquivo integrado ao banco de dados.",
            ]);

            return redirect()->route('admin.database.details');

        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => $err->getCode() == 1156 ? $err->getMessage() :  "Alguem problema ocorreu no momento de usar o arquivo. ",
            ]);

            return redirect()->route('admin.database.details');
        }

    }


    public function generate(DatabaseRepository $repository)
    {
        try {
            $return = $repository->generate();

            session()->flash('success', [
                'success' => true,
                'messages' => "Backup gerado com sucesso.",
            ]);

            return redirect()->route('admin.database.details');


        } catch (\Exception $err) {

            session()->flash('error', [
                'error' => true,
                'messages' => $err->getCode() == 1155 ? $err->getMessage() : "Aconteceu algum problema na página de administração de banco de dados.",
            ]);

            return redirect()->route('admin.items.list');
        }

    }


    public function destroy(Request $request, $name, DatabaseRepository $repository)
    {
        try {
            $items = $repository->destroy($name);

            session()->flash('success', [
                'success' => true,
                'messages' => "Backup deletado com sucesso.",
            ]);

            return redirect()->route('admin.database.details');


        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema na página de administração de banco de dados.",
            ]);

            return redirect()->route('admin.items.list');
        }

    }

    public function download(Request $request, $name, DatabaseRepository $repository)
    {
        try {

            //widonws
            $destination = storage_path('app\backup\\');
            //linux
            //$destination = storage_path('app/backup/');

            $pathToFile = $destination.$name;

            return response()->download($pathToFile,$name);

        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema na página de administração de banco de dados.",
            ]);

            return redirect()->route('admin.items.list');
        }

    }

    public function reset(DatabaseRepository $repository)
    {
        try {

            $repository->reset();

            session()->flash('success', [
                'success' => true,
                'messages' => "Banco zerado. Faço o login novamente para baixaramos seus dados",
            ]);

            return redirect()->route('free.logout');

        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema." .$err->getMessage(),
            ]);

            return redirect()->route('admin.database.details');
        }

    }

}
