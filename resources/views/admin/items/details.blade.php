@extends('template.admin.master')
@section('conteudo-view')
    <div class="container col-md-8 mt-5 pt-5">
        <h2 class="mb-5">Alterar Item de menu</h2>
        <form method="POST" action="{{route('admin.items.update', [$item->id])}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Titulo:</label>
                <input value="{{$item->title}}" type="text" class="form-control" name="title" id="title" placeholder="Titulo">
            </div>
            <div class="form-group">
                <label for="url">URL:</label>
                <input value="{{$item->url}}" type="text" class="form-control" name="url" id="url" placeholder="URL">
            </div>

            <div class="form-group">
                <label for="page">Pagina:</label>
                <select class="custom-select" name="page" id="page">
                    <option value="{{$item->page->id}}" selected>{{$item->page->description}}</option>
                    @foreach($pages as $page)
                        <option value="{{$page->id}}">{{$page->description}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Alterar</button>
            </div>
        </form>
    </div>
@stop

