@extends('template.master')
@section('conteudo-css')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous"></script>

@stop
@section('conteudo-view')

<div class="container-fluid bg-white bg-white py-3 shadow-sm">
    <div class="row">
      <div class="col-2 logo">
        <a href="#">
          <img src="/img/cropped-logo-160x60-1.png" class="pl-2">
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
    <div class="col-10">
      <nav aria-label="breadcrumb">
          {{\App\Helpers\Helper::generateBreadcrumb($page, $current)}}
      </nav>
    </div> <br>
    <div class="col-2">
      <a href="#" class="btn btn-lg btn-gradient">
          <i class="fas fa-star fa-2x"></i>
      </a>
        <a href="#" class="btn btn-lg btn-gradient">
            <i class="far fa-star fa-2x"></i>
        </a>
          {{--<a href="#" class="btn btn-lg btn-secondary">Remover dos Favoritos</a>--}}
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

