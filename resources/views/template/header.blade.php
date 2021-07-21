<header>
    <div class="container-fluid gradient">
      <div class="container text-right">

        <ul class="mb-0 menu-sites">
            <li>
                @yield('menu-search')
            </li>
          <li class="menu_topo">

              @if($favorites)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="menu-categorias" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Favoritos
                    </a>
                    <div class="dropdown-menu" aria-labelledby="menu-categorias" id="menu_portais">
                        @foreach($favorites as $favorite)
                            <a href="{{ route('auth.pages', [$favorite['slug_page'], $favorite['slug_item']]) }}" class="dropdown-item">{{ $favorite['description'] }}</a>
                        @endforeach
                    </div>
                </li>

            @endif

            @if($pages)
              <li class="nav-item dropdown">
                  <a href="#" class="nav-link dropdown-toggle" id="menu-categorias" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Meus Portais
                  </a>
                  <div class="dropdown-menu" aria-labelledby="menu-categorias" id="menu_portais">
                      @foreach($pages as $page)
                          <a href="{{ route('auth.pages', [$page->slug]) }}" class="dropdown-item">{{ $page->description }}</a>
                      @endforeach
                  </div>
              </li>
            @endif
          </li>

          <li class="item_usuario">
            <li class="nav-item">
                @if(session('userName'))
                    @if(session('userAccess'))
                        <a class="nav-link" href="{{ route('admin.users.list') }}">{{ session('userName') }}</a>
                    @else
                            <a class="nav-link">{{ session('userName') }}</a>
                    @endif
                @else
                        <a class="nav-link" href="{{ route('free.index') }}">HOME</a>
                @endif
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ session('userName') ? route('free.logout') : route('free.login') }}">{{ session('userName') ? 'SAIR' : 'ACESSAR' }}</a>
            </li>
          </li>
        </ul>
      </div>
    </div>

</header>

