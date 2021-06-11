@extends('template.master')
@section('conteudo-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous"></script>

@stop

@section('submenu-view')
    <div class="container-fluid bg-white bg-white mb-2 shadow-sm">
        <div class="row">
            <div class="col-2 logo">
                <a href="{{ route('free.index')}}">

                    <img src="{{ asset('/img/cropped-logo-160x60-1.png') }}" class="pl-2">
                </a>
            </div>
        </div>
    </div>
@stop

@section('conteudo-view')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-{{session('userName') ? '10' : '12'}}">

        @if(empty(session('userName')))
            <div class="alert alert-info" role="alert">
                Você ainda não está logado. Faça o login e escolha uma página no topo dessa pagina.
            </div>
        @endif

            <article>
                <iframe src="https://portalparceiros.tokiomarine.com.br/portais/api/v1/power-bi/mobile/relatorio/16b366c5-85a0-47da-ab04-de71e1927ec3/bf6514c8-5449-4135-94b2-3c3e3ba86d7e"
                        id="iframe_funcionalidade" name="iframe_funcionalidade" frameborder="0" style="width: 100%; height: 80vh" scrolling="auto"></iframe>
            </article>

    </div>

    @if(session('userName'))
        <div class="col-md-2 lista_favoritos">
            <ul class="list-group">
                <li class="list-group-item active gradient">Favoritos</li>

                @foreach($favorites as $favorite)
                    <li class="list-group-item">
                        <a class="nav-link" href="{{ route('auth.pages', [$favorite['slug_page'], $favorite['slug_item']]) }}" >
                            {{ $favorite['description'] }}
                            <input id="desc-current-{{$favorite['id']}}" type="hidden" value="{{ $favorite['description'] }}">
                            <button type="button" id="{{$favorite['id']}}" class="btn btn-light edit-fav"><i class="fas fa-edit"></i></button>
                        </a>

                    </li>
                @endforeach
            </ul>
        </div>
    @endif


      <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel">Como quer nomear esse favorito?</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <input type="text" class="form-control" name="fav" id="fav">
                      <input type="hidden" class="form-control" name="id-fav" id="id-fav" value="">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-lg btn-outline-success" id="modal-btn-save" style="width:150px">Guardar</button>
                      <button type="button" class="btn btn-lg btn-outline-danger" id="modal-btn-delete" style="width:150px">Apagar</button>
                  </div>
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

                $(".edit-fav").on('click', function(e) {
                    e.preventDefault();

                    const id = $(this).attr('id');
                    const id_desc = "#desc-current-"+id;

                    $("#fav").val($(id_desc).val());
                    $("#id-fav").val(id);
                    $("#mi-modal").modal('show');
                });

                $("#modal-btn-save").on('click', function(e) {
                    e.preventDefault();
                    $("#mi-modal").modal('hide');
                    favOff();
                });

                $("#modal-btn-delete").on('click', function(e) {
                    e.preventDefault();
                    $("#mi-modal").modal('hide');
                    favOn();
                });

                function favOff() {
                    var url = "{{ route('portal.ajax.favorite.update') }}";

                    $.ajax({
                        type:'POST',
                        url: url,
                        data:{
                            id_current:  $("#id-fav").val(),
                            desc:  $("#fav").val(),
                            delete:  'include',
                        },

                        success:function(data){
                            window.location = '/';
                        },

                        error:function(data){
                            console.log(data);
                            console.log('Erro no Ajax!');
                        },

                    });
                }

                function favOn() {
                    var url = "{{ route('portal.ajax.favorite.update') }}";


                    $.ajax({
                        type:'POST',
                        url: url,
                        data:{
                            id_current:  $("#id-fav").val(),
                            delete:  'delete',
                        },

                        success:function(data){
                            window.location = '/';
                        },

                        error:function(data){
                            console.log('Erro no Ajax!');
                        },

                    });
                }
            });
        </script>
@stop

