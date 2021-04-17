@extends('template.admin.master')
@section('conteudo-view')
    <div class="container col-md-10">
        <h2 class="mb-5">Criar um Item de menu</h2>
        <form method="POST" action="{{route('admin.items.create')}}">
            @csrf
            <div class="form-group">
                <label for="title">Titulo:</label>
                <input value="" type="text" class="form-control" name="title" id="title" placeholder="Titulo">
            </div>
            <div class="form-group">
                <label for="url">URL:</label>
                <input value="" type="text" class="form-control" name="url" id="url" placeholder="URL">
            </div>

            <div class="form-group">
                <label for="page">Pagina:</label>
                <select class="custom-select" name="page" id="page">
                    @foreach($pages as $page)
                        <option value="{{$page->id}}">{{$page->description}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg btn-block">Criar</button>
            </div>
        </form>
    </div>
@stop

