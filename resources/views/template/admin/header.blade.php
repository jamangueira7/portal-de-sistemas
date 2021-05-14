<nav class="navbar fixed-top flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ route('free.index') }}">
        <img src="{{asset('img/cropped-logo-160x60-1.png')}}">
    </a>

    <ul class="navbar-nav px-3 col-2">
        <li class="nav-item text-nowrap">
            <a class="nav-link float-right mr-3" href="{{ route('free.logout') }}"><i class="fas fa-sign-out-alt"></i> Sair</a>
            <a class="nav-link " href="{{ route('free.index') }}"><i class="fas fa-home"></i> Home</a>
        </li>
    </ul>
</nav>
