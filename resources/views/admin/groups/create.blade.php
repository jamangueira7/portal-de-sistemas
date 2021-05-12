@extends('template.admin.master')
@section('conteudo-view')
    <div class="container col-md-10">
        <h2 class="mb-5">Criar um Grupo</h2>
        <form method="POST" action="{{route('admin.groups.create')}}">
            @csrf
            <div class="form-group">
                <label for="description">Descrição:</label>
                <input value="" type="text" class="form-control" name="description" id="description" placeholder="Descrição">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg btn-block">Criar</button>
            </div>
        </form>
    </div>
@stop

