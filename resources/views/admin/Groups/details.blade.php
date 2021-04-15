@extends('template.admin.master')
@section('conteudo-view')
    <div class="container col-md-10">
        <h2 class="mb-5">Alterar Item de menu</h2>
            <div class="form-group">
                <label for="description">Descrição:</label>
                <input value="{{$group->description}}" disabled type="text" class="form-control" name="description" id="description" placeholder="Titulo">
            </div>

        <div id="accordion">
            @foreach($group->users as $user)
                <div class="card">
                    <div class="card-header" id="heading-{{$user->id}}">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-{{$user->id}}" aria-expanded="true" aria-controls="collapse-{{$user->id}}">
                                {{$user->name}}
                            </button>
                        </h5>
                    </div>

                    <div id="collapse-{{$user->id}}" class="collapse" aria-labelledby="heading-{{$user->id}}" data-parent="#accordion">
                        <div class="card-body">
                            <label for="description">Eamil :{{$user->email}}</label><br>
                            <label for="description">Login: {{$user->login}}</label>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


    </div>
@stop


