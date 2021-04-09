@extends('template.master')
@section('conteudo-view')
<div class="container">
    <div class="row">
        <div class="col">
    <div class="conteudo-login">
        <img src="img/logo-login.png">
        <form action="" class="class-form">
            <label for="login">Login</label>
            <input type="text" name="login">
            <label for="senha">Senha</label>
            <input type="text" name="senha">
            <button class="btn" type="submit">Acessar</button>

        </form>
    </div>

    </div>
    </div>
</div>
@stop

