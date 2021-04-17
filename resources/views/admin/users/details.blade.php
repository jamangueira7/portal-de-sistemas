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


            <label for="groups">Grupos:</label>
            <div class="form-group row">
                @foreach($groups as $group)
                    <div class="form-check col-3">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="check-{{$group->id}}"
                            name="groups[]"
                            value="{{$group->id}}"
                            {{in_array($group->id, $user_groups) ? 'checked' : ''}}
                        >
                        <label class="form-check-label" for="check-{{$group->id}}">{{$group->description}}</label>
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Alterar</button>
            </div>
        </form>
    </div>
@stop

@section('js-view')
@stop
