@extends('template.admin.master')

@section('conteudo-css')
@stop

@section('conteudo-view')
    <div class="container col-md-10">
        <h2 class="mb-5">Alterar usuário</h2>
        <form method="POST" action="{{route('admin.users.update', [$user->id])}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nome:</label>
                <input value="{{$user->name}}" type="text" class="form-control" name="name" id="name" placeholder="Titulo">
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input disabled value="{{$user->email}}" type="text" class="form-control" name="email" id="email" placeholder="URL">
            </div>

            <div class="form-group">
                <label for="login">Login:</label>
                <input disabled value="{{$user->login}}" type="text" class="form-control" name="login" id="login" placeholder="URL">
            </div>

            @include('suport.selectListGroups', [
                'model' => $groups,
                'model_groups' => $user_groups,
                'label' => 'Grupos:',
            ])


            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Alterar</button>
            </div>
        </form>
    </div>
@stop

@section('js-view')
@stop
