<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\DatabaseRepository;
use Illuminate\Http\File;
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
            Log::info($err);
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

    public function create(Request $request, DatabaseRepository $repository)
    {

        try {

            $return = $repository->create($request->file('archive'));

            session()->flash('success', [
                'success' => true,
                'messages' => "Arquivo de Backup subiu com sucesso.",
            ]);

            return redirect()->route('admin.database.details');


        } catch (\Exception $err) {

            session()->flash('error', [
                'error' => true,
                'messages' => $err->getCode() == 1155 ? $err->getMessage() : "Erro ao subir arquivo.",
            ]);

            return redirect()->route('admin.database.details');
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

    public function download($name)
    {
        try {

            //widonws
            //$destination = storage_path('app\backup\\');
            //linux
            $destination = storage_path('app/public/');

            $pathToFile = $destination.$name;
            $headers = [
                    'Access-Control-Allow-Origin' => '*',
                    'Content-Type:' => 'application/json',
                    'Content-Disposition' => 'attachment; filename='.$pathToFile
                ];


            return response()->download($pathToFile, $name, $headers);

        } catch (\Exception $err) {
            session()->flash('error', [
                'error' => true,
                'messages' => "Aconteceu algum problema na página de administração de banco de dados.".$err->getMessage(),
            ]);

            return redirect()->route('admin.database.details');
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
