<div class="main d-flex flex-column justify-content-between">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Rental Buku</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="navbar-nav" style="margin-right: 30px;">
                <li class="nav-item">
                  <a class="nav-link fw-bold" aria-current="page" href="/profile">{{ auth()->user()->username }}</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="body-content h-100">
        <div class="row g-0 h-100">
            <div class="sidebar col-lg-2 collapse d-lg-block text-white" id="navbarNav">
                    @if (auth()->user()->role_id == 1)
                        <a href="/dashboard" class="links {{ (Request::is('dashboard*') ? 'active' : '') }}">Dashboard</a>
                        <a href="/books" class="links {{ (Request::is('books*') ? 'active' : '') }}">Books</a>
                        <a href="/categories" class="links {{ (Request::is('categories*') ? 'active' : '')}} 
                            {{ (Request::is('category*') ? 'active' : '') }}">
                            Categories
                        </a>
                        <a href="/users" class="links {{ (Request::is('users*') ? 'active' : '') }}">User</a>
                        <a href="/rent-logs" class="links {{ (Request::is('rent-logs*') ? 'active' : '') }}">Rent Log</a>
                        <a href="/logout" class="links {{ (Request::is('logout*') ? 'active' : '') }}">Logout</a>
                    @else
                        <a href="/profile" class="links {{ (Request::is('profile*') ? 'active' : '') }}">Profile</a>
                        <a href="/logout" class="links {{ (Request::is('logout*') ? 'active' : '') }}">Logout</a>
                    @endif
            </div>
            <div class="content col-lg-9 p-4">
                @yield('content')
            </div>
        </div>
    </div>
</div>
