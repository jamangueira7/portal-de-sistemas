@extends('template.master')
@section('conteudo-view')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="conteudo-login">
                <img src="">
                <form method="POST" action="{{route('free.authenticate')}}" class="class-form shadow border-0">
                    @csrf
                    <label for="login">Usuário</label>
                    <input class="form-control" type="text" placeholder="Digite seu usuário de rede" name="login">
                    <label for="password">Senha</label>
                    <input class="form-control" type="password" placeholder="Digite sua senha de rede" name="password">
                    <button class="mt-3 btn tokio-gradient btn-lg" type="submit">Acessar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

