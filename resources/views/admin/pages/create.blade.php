@extends('template.admin.master')
@section('conteudo-view')
    <div class="container col-md-10">
        <h2 class="mb-5">Criar uma Página</h2>
        <form method="POST" action="{{route('admin.pages.create')}}">
            @csrf
            <div class="form-group">
                <label for="description">Descrição:</label>
                <input value="" type="text" class="form-control" name="description" id="description" placeholder="Descrição">
            </div>

            @include('suport.selectListGroups', [
                'model' => $groups,
                'model_groups' => $page_groups,
                'label' => 'Grupos:',
            ])

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg btn-block">Criar</button>
            </div>
        </form>
    </div>
@stop





