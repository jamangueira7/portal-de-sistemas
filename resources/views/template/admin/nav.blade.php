<nav class="col-md-2 d-none d-md-block bg-dark sidebar"
     style="height: 100% !important; overflow-y: hidden;"
>
    <div class="sidebar-sticky mt-5">
        <ul class="nav flex-column pt-5">
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.users.list')}}">
                    <i class="fas fa-users"></i> Usuários

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.groups.list')}}">
                    <i class="fas fa-layer-group"></i> Grupos
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.pages.list')}}">
                    <i class="fas fa-file-alt"></i> Paginas
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.items.list')}}">
                    <i class="fas fa-sitemap"></i> Itens do menu
                </a>
            </li>

        </ul>
    </div>
</nav>
