@extends('template.master')
@section('conteudo-css')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous"></script>

    <style type="text/css">
        .navbar .megamenu{ padding: 1rem; }

        li {
            list-style-type: none;
        }

        .col-megamenu, .col-megamenu h6 {
            font-size: 13px;
        }

        .has-megamenu > a  {
            font-size: 13px;
            font-weight: 500;
            color: #5b5b5b;
        }

        /* ============ desktop view ============ */
        @media all and (min-width: 992px) {

            .navbar .has-megamenu{position:static!important;}
            .navbar .megamenu{left:0; right:0; width:100%; margin-top:0;  }

        }
        /* ============ desktop view .end// ============ */


        /* ============ mobile view ============ */
        @media(max-width: 991px){
            .navbar.fixed-top .navbar-collapse, .navbar.sticky-top .navbar-collapse{
                overflow-y: auto;
                max-height: 90vh;
                margin-top:10px;
            }
        }
        /* ============ mobile view .end// ============ */
    </style>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function(){
            /////// Prevent closing from click inside dropdown
            document.querySelectorAll('.dropdown-menu').forEach(function(element){
                element.addEventListener('click', function (e) {
                    e.stopPropagation();
                });
            })
        });
    </script>
@stop
@section('conteudo-view')

<div class="container-fluid bg-white bg-white mb-2 shadow-sm">
    <div class="row d-flex justify-content-between">
      <div class="col-2 logo d-flex">

        <a href="{{ route('free.index') }}">
          <!-- <img src="/img/cropped-logo-160x60-1.png" class="pl-2"> -->
          <img src="{{ asset('/img/cropped-logo-160x60-1.png') }}" class="pl-2">

        </a>
      </div>

      <div class="col-10 d-flex">
          <div class="container">
              <nav class="navbar navbar-expand-lg">
                  <div class="container-fluid">
                      <div class="collapse navbar-collapse" id="main_nav">
                            {{\App\Helpers\Helper::gerarFilhos($page, $page['page']['slug'])}}
                      </div> <!-- navbar-collapse.// -->
                  </div> <!-- container-fluid.// -->
              </nav>
          </div>
      </div>
    </div>
</div>
<div class="container-fluid">

  <div class="row">
    <div class="col-11">
      <nav aria-label="breadcrumb">
          {{\App\Helpers\Helper::generateBreadcrumb($page, $current)}}
      </nav>
    </div> <br>
    <div class="col-1">
        <input id="slug-type" type="hidden" value="{{ !empty($current) ? 'item' : 'page' }}">
        <input id="desc-current" type="hidden" value="{{ !empty($current) ? $current['title'] : $page['page']['description'] }}">
        <input id="id-current" type="hidden" value="{{ !empty($current) ? $current['id'] : $page['page']['id'] }}">

        <a
            href="#"
           id="favorite-on"
           class="btn btn-lg btn-gradient"
            data-title="Clique para retirar dos favoritos"
           style="display: {!! !$favorite ? 'none' : 'block' !!};"
        >
          <i class="fas fa-star"></i>
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


          @if(!empty($current))
              <article>
                  <iframe src="{{ $current['url'] }}"
                          id="iframe_funcionalidade" name="iframe_funcionalidade" frameborder="0" style="width: 100%; height: 80vh" scrolling="auto"></iframe>
              </article>
          @endif
        </div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Como quer nomear esse favorito?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" name="fav" id="fav">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-lg btn-outline-success" id="modal-btn-save" style="width:150px">Guardar</button>
            </div>
        </div>
    </div>
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

            $("#favorite-off").on('click', function(e) {
                e.preventDefault();

                $("#fav").val($("#desc-current").val());
                $("#mi-modal").modal('show');
            });

            $("#modal-btn-save").on('click', function(e) {
                e.preventDefault();
                $("#mi-modal").modal('hide');
                favOff();
            });

            function favOff() {
                var url = "{{ route('portal.ajax.favorite.alter') }}";

                $.ajax({
                    type:'POST',
                    url: url,
                    data:{
                        slug_type:  $("#slug-type").val(),
                        id_current:  $("#id-current").val(),
                        desc:  $("#fav").val(),
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
            }

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
        });
    </script>
@stop
