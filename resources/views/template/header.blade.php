<header>
    <div class="container-fluid gradient">
      <div class="container text-right">

        <ul class="mb-0 py-2 menu-sites">
          <li class="menu_topo">

            @if($pages)
              <li class="nav-item dropdown">
                  <a href="#" class="nav-link dropdown-toggle" id="menu-categorias" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Meus Portais
                  </a>
                  <div class="dropdown-menu" aria-labelledby="menu-categorias">
                      @foreach($pages as $page)
                          <a href="{{ route('auth.pages', [$page->slug]) }}" class="dropdown-item">{{ $page->description }}</a>
                      @endforeach
                  </div>
              </li>
            @endif
          </li>
          <li class="item_usuario">
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.users.list')}}">{{ session('userName') ? session('userName') : '' }}</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ session('userName') ? route('free.logout') : route('free.login') }}">{{ session('userName') ? 'SAIR' : 'ACESSAR' }}</a>
            </li>
          </li>
        </ul>
      </div>
    </div>

</header>

