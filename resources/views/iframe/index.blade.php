@extends('template.master')
@section('conteudo-css')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous"></script>

    <style>
        #menu-items {
            list-style: url({{asset('img/right-arrow.svg')}});
            background-color: #6c757d;
            border-radius: 3%;
        }
        .dropdown-menu-right {
            width:400px;
        }
    </style>
@stop
@section('conteudo-view')

<div class="container">
  <div class="row">
      <br><br><br>
    <div class="col-md-10">

        <div id="menu-items" class="form-group row">
            <div class="col-3">
                <span>Menu 1</span>
                <ul class="">
                    <li class="">Item 1</li>
                    <li class="">Item 2</li>
                    <li class="">Item 3</li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">Item 4</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="">Item 1</li>
                            <li class="nav-item dropdown">
                                <a class="" href="#" >Item 2</a>
                                <ul class="">
                                    <li class="">Item 1</li>
                                    <li class="">Item 2</li>
                                    <li class="">Item 3</li>
                                    <li class="">Item 4</li>
                                    <li class="">Item 5</li>
                                </ul>
                            </li>
                            <li class=""><a href="#">Item 3</a></li>
                            <li class="">Item 4</li>
                            <li class="">
                                Item 5
                                <ul class="">
                                    <li class="">Item 1</li>
                                    <li class="">
                                        Item 2
                                        <ul class="">
                                            <li class="">Item 1</li>
                                            <li class="">Item 2</li>
                                            <li class="">Item 3</li>
                                            <li class="">Item 4</li>
                                            <li class="">Item 5</li>
                                        </ul>
                                    </li>
                                    <li class="">Item 3
                                        <ul class="">
                                            <li class="">Item 1</li>
                                            <li class="">Item 2</li>
                                            <li class="">Item 3</li>
                                            <li class="">Item 4</li>
                                            <li class="">Item 5</li>
                                        </ul>
                                    </li>
                                    <li class="">Item 4</li>
                                    <li class="">Item 5</li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="">Item 5</li>
                </ul>
            </div>
            <div class="col-3">
                <span>Menu 1</span>
                <ul class="">
                    <li class="">Item 1</li>
                    <li class="">Item 2</li>
                    <li class="">Item 3</li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">Item 4</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="">Item 1</li>
                            <li class="nav-item dropdown">
                                <a class="" href="#" >Item 2</a>
                                <ul class="">
                                    <li class="">Item 1</li>
                                    <li class="">Item 2</li>
                                    <li class="">Item 3</li>
                                    <li class="">Item 4</li>
                                    <li class="">Item 5</li>
                                </ul>
                            </li>
                            <li class=""><a href="#">Item 3</a></li>
                            <li class="">Item 4</li>
                            <li class="">
                                Item 5
                                <ul class="">
                                    <li class="">Item 1</li>
                                    <li class="">
                                        Item 2
                                        <ul class="">
                                            <li class="">Item 1</li>
                                            <li class="">Item 2</li>
                                            <li class="">Item 3</li>
                                            <li class="">Item 4</li>
                                            <li class="">Item 5</li>
                                        </ul>
                                    </li>
                                    <li class="">Item 3
                                        <ul class="">
                                            <li class="">Item 1</li>
                                            <li class="">Item 2</li>
                                            <li class="">Item 3</li>
                                            <li class="">Item 4</li>
                                            <li class="">Item 5</li>
                                        </ul>
                                    </li>
                                    <li class="">Item 4</li>
                                    <li class="">Item 5</li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="">Item 5</li>
                </ul>
            </div>
            <div class="col-3">
                <span>Menu 1</span>
                <ul class="">
                    <li class="">Item 1</li>
                    <li class="">Item 2</li>
                    <li class="">Item 3</li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">Item 4</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="">Item 1</li>
                            <li class="nav-item dropdown">
                                <a class="" href="#" >Item 2</a>
                                <ul class="">
                                    <li class="">Item 1</li>
                                    <li class="">Item 2</li>
                                    <li class="">Item 3</li>
                                    <li class="">Item 4</li>
                                    <li class="">Item 5</li>
                                </ul>
                            </li>
                            <li class=""><a href="#">Item 3</a></li>
                            <li class="">Item 4</li>
                            <li class="">
                                Item 5
                                <ul class="">
                                    <li class="">Item 1</li>
                                    <li class="">
                                        Item 2
                                        <ul class="">
                                            <li class="">Item 1</li>
                                            <li class="">Item 2</li>
                                            <li class="">Item 3</li>
                                            <li class="">Item 4</li>
                                            <li class="">Item 5</li>
                                        </ul>
                                    </li>
                                    <li class="">Item 3
                                        <ul class="">
                                            <li class="">Item 1</li>
                                            <li class="">Item 2</li>
                                            <li class="">Item 3</li>
                                            <li class="">Item 4</li>
                                            <li class="">Item 5</li>
                                        </ul>
                                    </li>
                                    <li class="">Item 4</li>
                                    <li class="">Item 5</li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="">Item 5</li>
                </ul>
            </div>
            <div class="col-3">
                <span>Menu 1</span>
                <ul class="">
                    <li class="">Item 1</li>
                    <li class="">Item 2</li>
                    <li class="">Item 3</li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">Item 4</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="">Item 1</li>
                            <li class="nav-item dropdown">
                                <a class="" href="#" >Item 2</a>
                                <ul class="">
                                    <li class="">Item 1</li>
                                    <li class="">Item 2</li>
                                    <li class="">Item 3</li>
                                    <li class="">Item 4</li>
                                    <li class="">Item 5</li>
                                </ul>
                            </li>
                            <li class=""><a href="#">Item 3</a></li>
                            <li class="">Item 4</li>
                            <li class="">
                                Item 5
                                <ul class="">
                                    <li class="">Item 1</li>
                                    <li class="">
                                        Item 2
                                        <ul class="">
                                            <li class="">Item 1</li>
                                            <li class="">Item 2</li>
                                            <li class="">Item 3</li>
                                            <li class="">Item 4</li>
                                            <li class="">Item 5</li>
                                        </ul>
                                    </li>
                                    <li class="">Item 3
                                        <ul class="">
                                            <li class="">Item 1</li>
                                            <li class="">Item 2</li>
                                            <li class="">Item 3</li>
                                            <li class="">Item 4</li>
                                            <li class="">Item 5</li>
                                        </ul>
                                    </li>
                                    <li class="">Item 4</li>
                                    <li class="">Item 5</li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="">Item 5</li>
                </ul>
            </div>
            <div class="col-3">
                <span>Menu 1</span>
                <ul class="">
                    <li class="">Item 1</li>
                    <li class="">Item 2</li>
                    <li class="">Item 3</li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">Item 4</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="">Item 1</li>
                            <li class="nav-item dropdown">
                                <a class="" href="#" >Item 2</a>
                                <ul class="">
                                    <li class="">Item 1</li>
                                    <li class="">Item 2</li>
                                    <li class="">Item 3</li>
                                    <li class="">Item 4</li>
                                    <li class="">Item 5</li>
                                </ul>
                            </li>
                            <li class=""><a href="#">Item 3</a></li>
                            <li class="">Item 4</li>
                            <li class="">
                                Item 5
                                <ul class="">
                                    <li class="">Item 1</li>
                                    <li class="">
                                        Item 2
                                        <ul class="">
                                            <li class="">Item 1</li>
                                            <li class="">Item 2</li>
                                            <li class="">Item 3</li>
                                            <li class="">Item 4</li>
                                            <li class="">Item 5</li>
                                        </ul>
                                    </li>
                                    <li class="">Item 3
                                        <ul class="">
                                            <li class="">Item 1</li>
                                            <li class="">Item 2</li>
                                            <li class="">Item 3</li>
                                            <li class="">Item 4</li>
                                            <li class="">Item 5</li>
                                        </ul>
                                    </li>
                                    <li class="">Item 4</li>
                                    <li class="">Item 5</li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="">Item 5</li>
                </ul>
            </div>
            <div class="col-3">
                <span>Menu 1</span>
                <ul class="">
                    <li class="">Item 1</li>
                    <li class="">Item 2</li>
                    <li class="">Item 3</li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">Item 4</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="">Item 1</li>
                            <li class="nav-item dropdown">
                                <a class="" href="#" >Item 2</a>
                                <ul class="">
                                    <li class="">Item 1</li>
                                    <li class="">Item 2</li>
                                    <li class="">Item 3</li>
                                    <li class="">Item 4</li>
                                    <li class="">Item 5</li>
                                </ul>
                            </li>
                            <li class=""><a href="#">Item 3</a></li>
                            <li class="">Item 4</li>
                            <li class="">
                                Item 5
                                <ul class="">
                                    <li class="">Item 1</li>
                                    <li class="">
                                        Item 2
                                        <ul class="">
                                            <li class="">Item 1</li>
                                            <li class="">Item 2</li>
                                            <li class="">Item 3</li>
                                            <li class="">Item 4</li>
                                            <li class="">Item 5</li>
                                        </ul>
                                    </li>
                                    <li class="">Item 3
                                        <ul class="">
                                            <li class="">Item 1</li>
                                            <li class="">Item 2</li>
                                            <li class="">Item 3</li>
                                            <li class="">Item 4</li>
                                            <li class="">Item 5</li>
                                        </ul>
                                    </li>
                                    <li class="">Item 4</li>
                                    <li class="">Item 5</li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="">Item 5</li>
                </ul>
            </div>
            <div class="col-3">
                <span>Menu 1</span>
                <ul class="">
                    <li class="">Item 1</li>
                    <li class="">Item 2</li>
                    <li class="">Item 3</li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">Item 4</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="">Item 1</li>
                            <li class="nav-item dropdown">
                                <a class="" href="#" >Item 2</a>
                                <ul class="">
                                    <li class="">Item 1</li>
                                    <li class="">Item 2</li>
                                    <li class="">Item 3</li>
                                    <li class="">Item 4</li>
                                    <li class="">Item 5</li>
                                </ul>
                            </li>
                            <li class=""><a href="#">Item 3</a></li>
                            <li class="">Item 4</li>
                            <li class="">
                                Item 5
                                <ul class="">
                                    <li class="">Item 1</li>
                                    <li class="">
                                        Item 2
                                        <ul class="">
                                            <li class="">Item 1</li>
                                            <li class="">Item 2</li>
                                            <li class="">Item 3</li>
                                            <li class="">Item 4</li>
                                            <li class="">Item 5</li>
                                        </ul>
                                    </li>
                                    <li class="">Item 3
                                        <ul class="">
                                            <li class="">Item 1</li>
                                            <li class="">Item 2</li>
                                            <li class="">Item 3</li>
                                            <li class="">Item 4</li>
                                            <li class="">Item 5</li>
                                        </ul>
                                    </li>
                                    <li class="">Item 4</li>
                                    <li class="">Item 5</li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="">Item 5</li>
                </ul>
            </div>
            <div class="col-3">
                <span>Menu 1</span>
                <ul class="">
                    <li class="">Item 1</li>
                    <li class="">Item 2</li>
                    <li class="">Item 3</li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">Item 4</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="">Item 1</li>
                            <li class="nav-item dropdown">
                                <a class="" href="#" >Item 2</a>
                                <ul class="">
                                    <li class="">Item 1</li>
                                    <li class="">Item 2</li>
                                    <li class="">Item 3</li>
                                    <li class="">Item 4</li>
                                    <li class="">Item 5</li>
                                </ul>
                            </li>
                            <li class=""><a href="#">Item 3</a></li>
                            <li class="">Item 4</li>
                            <li class="">
                                Item 5
                                <ul class="">
                                    <li class="">Item 1</li>
                                    <li class="">
                                        Item 2
                                        <ul class="">
                                            <li class="">Item 1</li>
                                            <li class="">Item 2</li>
                                            <li class="">Item 3</li>
                                            <li class="">Item 4</li>
                                            <li class="">Item 5</li>
                                        </ul>
                                    </li>
                                    <li class="">Item 3
                                        <ul class="">
                                            <li class="">Item 1</li>
                                            <li class="">Item 2</li>
                                            <li class="">Item 3</li>
                                            <li class="">Item 4</li>
                                            <li class="">Item 5</li>
                                        </ul>
                                    </li>
                                    <li class="">Item 4</li>
                                    <li class="">Item 5</li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="">Item 5</li>
                </ul>
            </div>
            <div class="col-3">
                <span>Menu 1</span>
                <ul class="">
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">Item 1</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="">Item 1666</li>
                            <li class="nav-item dropdown">
                                <a class="" href="#" >Item 266</a>
                                <ul class="">
                                    <li class="">Item 1</li>
                                    <li class="">Item 2</li>
                                    <li class="">Item 3</li>
                                    <li class="">Item 4</li>
                                    <li class="">Item 5</li>
                                </ul>
                            </li>
                            <li class=""><a href="#">Item 3</a></li>
                            <li class="">Item 4</li>
                            <li class="">
                                Item 5
                                <ul class="">
                                    <li class="">Item 1</li>
                                    <li class="">
                                        Item 2
                                        <ul class="">
                                            <li class="">Item 1</li>
                                            <li class="">Item 2</li>
                                            <li class="">Item 3</li>
                                            <li class="">Item 4</li>
                                            <li class="">Item 5</li>
                                        </ul>
                                    </li>
                                    <li class="">Item 3
                                        <ul class="">
                                            <li class="">Item 1</li>
                                            <li class="">Item 2</li>
                                            <li class="">Item 3</li>
                                            <li class="">Item 4</li>
                                            <li class="">
                                                Item 5
                                                <ul class="">
                                                    <li class="">Item 1</li>
                                                    <li class="">
                                                        Item 2
                                                        <ul class="">
                                                            <li class="">Item 1</li>
                                                            <li class="">Item 2</li>
                                                            <li class="">Item 3</li>
                                                            <li class="">Item 4</li>
                                                            <li class="">Item 5</li>
                                                        </ul>
                                                    </li>
                                                    <li class="">Item 3</li>
                                                    <li class="">Item 4</li>
                                                    <li class="">Item 5</li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="">Item 4</li>
                                    <li class="">Item 5</li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="">Item 2</li>
                    <li class="">Item 3</li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">Item 4</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="">Item 1</li>
                            <li class="nav-item dropdown">
                                <a class="" href="#" >Item 2</a>
                                <ul class="">
                                    <li class="">Item 1</li>
                                    <li class="">Item 2</li>
                                    <li class="">Item 3</li>
                                    <li class="">Item 4</li>
                                    <li class="">Item 5</li>
                                </ul>
                            </li>
                            <li class=""><a href="#">Item 3</a></li>
                            <li class="">Item 4</li>
                            <li class="">
                                Item 5
                                <ul class="">
                                    <li class="">Item 1</li>
                                    <li class="">
                                        Item 2
                                        <ul class="">
                                            <li class="">Item 1</li>
                                            <li class="">Item 2</li>
                                            <li class="">Item 3</li>
                                            <li class="">Item 4</li>
                                            <li class="">Item 5</li>
                                        </ul>
                                    </li>
                                    <li class="">Item 3
                                        <ul class="">
                                            <li class="">Item 1</li>
                                            <li class="">Item 2</li>
                                            <li class="">Item 3</li>
                                            <li class="">Item 4</li>
                                            <li class="">
                                                Item 5
                                                <ul class="">
                                                    <li class="">Item 1</li>
                                                    <li class="">
                                                        Item 2
                                                        <ul class="">
                                                            <li class="">Item 1</li>
                                                            <li class="">Item 2</li>
                                                            <li class="">Item 3</li>
                                                            <li class="">Item 4</li>
                                                            <li class="">Item 5</li>
                                                        </ul>
                                                    </li>
                                                    <li class="">Item 3</li>
                                                    <li class="">Item 4</li>
                                                    <li class="">Item 5</li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="">Item 4</li>
                                    <li class="">Item 5</li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="">Item 5</li>
                </ul>
            </div>
        </div>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <a href="{{ route('auth.pages', [$page['page']['slug']]) }}" class="badge badge-primary">--> {{ $page['page']['description'] }}</a>

        {{\App\Helpers\Helper::gerarFilhos($page, $page['page']['slug'])}}
        <br>

        @if(!empty($current))
            <article>
                <iframe src="{{ $current['url'] }}"
                        id="iframe_funcionalidade" name="iframe_funcionalidade" frameborder="0" style="width: 100%; height: 80vh" scrolling="auto"></iframe>
            </article>
        @endif

    </div>

    <div class="col-md-2">
        <a href="https://www.youtube.com/watch?v=ACuh9eP0WRM" target="_blank" class="btn-video btn btn-gradient my-3">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 16 18">
            <g id="play" transform="translate(16) rotate(90)" fill="none">
              <path d="M7.257,3.1a2,2,0,0,1,3.486,0l5.58,9.921A2,2,0,0,1,14.58,16H3.42a2,2,0,0,1-1.743-2.981Z" stroke="none"/>
              <path d="M 9 4.07945728302002 L 9.000000953674316 4.079455375671387 L 3.41969108581543 13.99999618530273 L 14.58030128479004 13.99999618530273 L 9.00001049041748 4.079475402832031 C 9.000007629394531 4.079469680786133 9.000003814697266 4.079463005065918 9 4.07945728302002 M 9.000000953674316 2.079461097717285 C 9.680423736572266 2.079461097717285 10.3608455657959 2.419285774230957 10.74315071105957 3.098936080932617 L 16.32345008850098 13.01947593688965 C 17.07339096069336 14.35268592834473 16.10996055603027 15.99999618530273 14.58030128479004 15.99999618530273 L 3.41969108581543 15.99999618530273 C 1.890041351318359 15.99999618530273 0.9266109466552734 14.35268592834473 1.676540374755859 13.01947593688965 L 7.256851196289063 3.098936080932617 C 7.639156341552734 2.419285774230957 8.319578170776367 2.079461097717285 9.000000953674316 2.079461097717285 Z" stroke="none" fill="#fff"/>
            </g>
          </svg>
         <p>Assista o tutorial no Youtube!</p>
        </a>
      <div class="lista_favoritos ">
        <p>favoritos</p>
      </div>
    </div>
  </div>
</div>
@stop

