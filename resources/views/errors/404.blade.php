<?php
$pages = [];
?>
@extends('template.master')
@section('conteudo-view')
    <div class="container" id="container-404">
            <span>Você está perdido?</span>
            <span class="erro404">404 - Página não encontrada.</span>
            <span>Volte para a homepage.</span>
            <a class="btn btn-info btn-info gradient btn-lg" id="btn-404" href="{{route('free.index')}}">Home</a>
    </div>
@stop

