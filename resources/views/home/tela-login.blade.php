@extends('template.master')
@section('conteudo-view')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="conteudo-login">
                <img src="img/logo-login.png">
                <form method="POST" action="{{route('free.authenticate')}}" class="class-form">
                    @csrf
                    <label for="login">Login</label>
                    <input type="text" name="login">
                    <label for="password">Senha</label>
                    <input type="text" name="password">
                    <button class="btn" type="submit">Acessar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

