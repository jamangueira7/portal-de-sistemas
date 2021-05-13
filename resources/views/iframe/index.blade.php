@extends('template.master')
@section('conteudo-css')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous"></script>

    <!-- <style>
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
    </style> -->
@stop
@section('conteudo-view')

<div class="container">
  <div class="row">
      <br><br><br>
    <div class="col-md-12">
        <!-- teste menu -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm">
    <a href="#" class="navbar-brand font-weight-bold d-block d-lg-none">MegaMenu</a>
    <button type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
            <span class="navbar-toggler-icon"></span>
        </button>
    <div id="navbarContent" class="collapse navbar-collapse">
      <ul class="navbar-nav mx-auto">
        <!-- Megamenu-->
        <li class="nav-item dropdown megamenu"><a id="megamneu" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle font-weight-bold text-uppercase">Mega Menu</a>
          <div aria-labelledby="megamneu" class="dropdown-menu border-0 p-0 m-0">
            <div class="container">
              <div class="row bg-white rounded-0 m-0 shadow-sm">
                <div class="col-lg-7 col-xl-8">
                  <div class="p-4">
                    <div class="row">
                      <div class="col-lg-6 mb-4">
                        <h6 class="font-weight-bold text-uppercase">MegaMenu heading</h6>
                        <ul class="list-unstyled">
                          <li class="nav-item"><a href="" class="nav-link text-small pb-0">Unique Features</a></li>
                          <li class="nav-item"><a href="" class="nav-link text-small pb-0 ">Image Responsive</a></li>
                          <li class="nav-item"><a href="" class="nav-link text-small pb-0 ">Auto Carousel</a></li>
                          <li class="nav-item"><a href="" class="nav-link text-small pb-0 ">Newsletter Form</a></li>
                        </ul>
                      </div>
                      <div class="col-lg-6 mb-4">
                        <h6 class="font-weight-bold text-uppercase">MegaMenu heading</h6>
                        <ul class="list-unstyled">
                          <li class="nav-item"><a href="" class="nav-link text-small pb-0 ">Unique Features</a></li>
                          <li class="nav-item"><a href="" class="nav-link text-small pb-0 ">Image Responsive</a></li>
                          <li class="nav-item"><a href="" class="nav-link text-small pb-0 ">Auto Carousel</a></li>
                          <li class="nav-item"><a href="" class="nav-link text-small pb-0 ">Newsletter Form</a></li>
                        </ul>
                      </div>
                      <div class="col-lg-6 mb-4">
                        <h6 class="font-weight-bold text-uppercase">MegaMenu heading</h6>
                        <ul class="list-unstyled">
                          <li class="nav-item"><a href="" class="nav-link text-small pb-0 ">Unique Features</a></li>
                          <li class="nav-item"><a href="" class="nav-link text-small pb-0 ">Image Responsive</a></li>
                          <li class="nav-item"><a href="" class="nav-link text-small pb-0 ">Auto Carousel</a></li>
                          <li class="nav-item"><a href="" class="nav-link text-small pb-0 ">Newsletter Form</a></li>
                        </ul>
                      </div>
                      <div class="col-lg-6 mb-4">
                        <h6 class="font-weight-bold text-uppercase">MegaMenu heading</h6>
                        <ul class="list-unstyled">
                          <li class="nav-item"><a href="" class="nav-link text-small pb-0 ">Unique Features</a></li>
                          <li class="nav-item"><a href="" class="nav-link text-small pb-0 ">Image Responsive</a></li>
                          <li class="nav-item"><a href="" class="nav-link text-small pb-0 ">Auto Carousel</a></li>
                          <li class="nav-item"><a href="" class="nav-link text-small pb-0 ">Newsletter Form</a></li>
                        </ul>
                      </div>
                    </div>as
                  </div>
                </div>
                <div class="col-lg-5 col-xl-4 px-0 d-none d-lg-block" style="background: center center url(https://res.cloudinary.com/mhmd/image/upload/v1556990826/mega_bmtcdb.png)no-repeat; background-size: cover;"></div>
              </div>
            </div>
          </div>
        </li>
        <li class="nav-item"><a href="" class="nav-link font-weight-bold text-uppercase">About</a></li>
        <li class="nav-item"><a href="" class="nav-link font-weight-bold text-uppercase">Services</a></li>
        <li class="nav-item"><a href="" class="nav-link font-weight-bold text-uppercase">Contact</a></li>
      </ul>
    </div>
  </nav>
        <!-- fim teste menu -->
<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm">
    <a href="#" class="navbar-brand font-weight-bold d-block d-lg-none">MegaMenu</a>
    <button type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
            <span class="navbar-toggler-icon"></span>
        </button>
    <div id="navbarContent" class="collapse navbar-collapse">
    <ul class="navbar-nav mx-auto">



        {{\App\Helpers\Helper::gerarFilhos($page, $page['page']['slug'])}}
    </ul>
  </div>
</nav>
  
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

