@extends('template.master')
@section('conteudo-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous"></script>

@stop
@section('conteudo-view')

<div class="container-fluid bg-white bg-white py-3 shadow-sm">
    <div class="row">
      <div class="col-2 logo">

        <a href="{{ route('free.index') }}">
          <!-- <img src="/img/cropped-logo-160x60-1.png" class="pl-2"> -->
          <img src="{{ asset('/img/cropped-logo-160x60-1.png') }}" class="pl-2">

        </a>
      </div>

      <div class="col-10 d-flex">
          <nav class="navbar navbar-expand-lg navbar-light ">
            <div id="navbarContent" class="collapse navbar-collapse">

               {{\App\Helpers\Helper::gerarFilhos($page, $page['page']['slug'])}}

            </div>
          </nav>
      </div>
    </div>
</div>
<div class="container-fluid mt-3">

  <div class="row">
    <div class="col-11">
      <nav aria-label="breadcrumb">
          {{\App\Helpers\Helper::generateBreadcrumb($page, $current)}}
      </nav>
    </div> <br>
    <div class="col-1">
        <input id="slug-type" type="hidden" value="{{ !empty($current) ? 'item' : 'page' }}">
        <input id="id-current" type="hidden" value="{{ !empty($current) ? $current['id'] : $page['page']['id'] }}">

        <a
            href="#"
           id="favorite-on"
           class="btn btn-lg btn-gradient"
            data-title="Clique para retirar dos favoritos"
           style="display: {!! !$favorite ? 'none' : 'block' !!};"
        >
          <i class="fas fa-star fa-2x"></i>
        </a>

        <a
            href="#"
            id="favorite-off"
            class="btn btn-lg btn-gradient"
            data-title="Clique para colocar nos favoritos"
            style="display: {!! $favorite ? 'none' : 'block' !!};"
        >
            <i class="far fa-star"></i>

        </a>
    </div>
  </div>
</div>
        <div class="container-fluid">
          <br>

          @if(!empty($current))
              <article>
                  <iframe src="{{ $current['url'] }}"
                          id="iframe_funcionalidade" name="iframe_funcionalidade" frameborder="0" style="width: 100%; height: 80vh" scrolling="auto"></iframe>
              </article>
          @endif
        </div>

@stop

@section('js-view')
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.0.min.js"></script>
    <script>

        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#favorite-on").on('click', function(e) {
                e.preventDefault();

                var url = "{{ route('portal.ajax.favorite.alter') }}";

                $.ajax({
                    type:'POST',
                    url: url,
                    data:{
                        slug_type:  $("#slug-type").val(),
                        id_current:  $("#id-current").val(),
                        delete:  'delete',
                    },

                    success:function(data){
                        $("#favorite-on").css("display", "none");
                        $("#favorite-off").css("display", "block");
                    },

                    error:function(data){
                        console.log('Erro no Ajax!');
                    },

                });
            });

            $("#favorite-off").on('click', function(e) {
                e.preventDefault();

                var url = "{{ route('portal.ajax.favorite.alter') }}";

                $.ajax({
                    type:'POST',
                    url: url,
                    data:{
                        slug_type:  $("#slug-type").val(),
                        id_current:  $("#id-current").val(),
                        delete:  'include',
                    },

                    success:function(data){
                        $("#favorite-on").css("display", "block");
                        $("#favorite-off").css("display", "none");
                    },

                    error:function(data){
                        console.log('Erro no Ajax!');
                    },

                });
            });
        });
    </script>
@stop
