@extends('template.master')
@section('conteudo-css')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous"></script>

    <style>
        #menu-items {
            list-style: url({{asset('img/right-arrow.svg')}});
            background-color: #6c757d;
            border-radius: 5px;
        }

        #menu-items a:link {
            color: white;
            text-decoration:none;
        }

        /* visited link */
        #menu-items  a:visited {
            color: white;
        }

        /* mouse over link */
        #menu-items  a:hover {
            color: #0b2e13;
        }

        /* selected link */
        #menu-items  a:active {
            color: white;
        }

        .dropdown-menu-right {
            min-width:500px;
            background-color: #6c757d;
            list-style: url({{asset('img/right-arrow.svg')}});
            padding-left: 20px;
            border-radius: 5px;
        }

        #title-page {
            font-size: 25px;
        }
    </style>
@stop
@section('conteudo-view')

<div class="container">
  <div class="row">
      <br><br><br>
    <div class="col-md-12">

        {{\App\Helpers\Helper::gerarFilhos($page, $page['page']['slug'])}}
        <br>

        @if(!empty($current))
            <article>
                <iframe src="{{ $current['url'] }}"
                        id="iframe_funcionalidade" name="iframe_funcionalidade" frameborder="0" style="width: 100%; height: 80vh" scrolling="auto"></iframe>
            </article>
        @endif

    </div>
  </div>
</div>
@stop

