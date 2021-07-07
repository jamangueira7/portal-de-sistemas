@extends('template.admin.master')

@section('conteudo-css')
@stop

@section('conteudo-view')
    <div class="container col-md-10">
        <h2 class="mb-5">Itens do usuário {{$user->name}}</h2>
            <div class="form-group">
                <label for="name">Nome:</label>
                <input disabled value="{{$user->name}}" type="text" class="form-control" name="name" id="name" placeholder="Titulo">
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input disabled value="{{$user->email}}" type="text" class="form-control" name="email" id="email" placeholder="URL">
            </div>

            <div class="form-group">
                <label for="login">Login:</label>
                <input disabled value="{{$user->login}}" type="text" class="form-control" name="login" id="login" placeholder="URL">
            </div>

        <table class="table table-striped" id="table">
            <thead>
            <tr>
                <th scope="col">Titulo</th>
                <th scope="col">Página</th>
                <th scope="col">Acessar</th>
            </tr>
            </thead>
            <tbody>
            @foreach($user->items as $item)
                <tr>
                    <td>{{$item->title}}</td>
                    <td>{{$item->page->description}}</td>
                    <td>
                        <a href="{{route('admin.items.details', [$item->id])}}" type="button" class="btn btn-outline-warning">Detalhe Item</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@stop

@section('js-view')
@stop
