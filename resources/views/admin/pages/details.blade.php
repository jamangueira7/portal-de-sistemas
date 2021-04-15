@extends('template.admin.master')
@section('conteudo-view')
    <div class="container col-md-10">
        <h2 class="mb-5">Alterar Item de menu</h2>
        <form method="POST" action="{{route('admin.pages.update', [$page->id])}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="description">Titulo:</label>
                <input value="{{$page->description}}" type="text" class="form-control" name="description" id="description" placeholder="Titulo">
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Alterar</button>
            </div>
        </form>
    </div>
@stop


