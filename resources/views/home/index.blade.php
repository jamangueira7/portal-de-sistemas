@extends('template.master')
@section('conteudo-view')
    <div class="container-fluid bg-white bg-white py-2 shadow-sm">
        <div class="row">
            <div class="col-2 logo">
                <a href="{{ route('free.index')}}">

                    <img src="{{ asset('/img/cropped-logo-160x60-1.png') }}" class="pl-2">
                </a>
            </div>
        </div>
    </div>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-{{session('userName') ? '10' : '12'}}">

        @if(empty(session('userName')))
            <br>
            <div class="alert alert-info" role="alert">
                Você ainda não está logado. Faça o login e escolha uma página no topo dessa pagina.
            </div>
        @endif

            <article>
                <iframe src="https://portalparceiros.tokiomarine.com.br/portais/api/v1/power-bi/mobile/relatorio/1ee33b1f-a3a8-4ac4-84e6-69763d71f679/bf6514c8-5449-4135-94b2-3c3e3ba86d7e"
                        id="iframe_funcionalidade" name="iframe_funcionalidade" frameborder="0" style="width: 100%; height: 80vh" scrolling="auto"></iframe>
            </article>

    </div>

    @if(session('userName'))
        <div class="col-md-2 lista_favoritos">
            <ul class="list-group">
                <li class="list-group-item active gradient">Favoritos</li>

                @foreach($favorites as $favorite)
                    <li class="list-group-item">
                        <a href="{{ route('auth.pages', [$favorite['slug_page'], $favorite['slug_item']]) }}" >{{ $favorite['description'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@stop

