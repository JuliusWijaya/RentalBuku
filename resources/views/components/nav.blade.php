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
                        <a href="/dashboard" class="links {{ (Request::is('dashboard*') ? 'actived' : '') }}">Dashboard</a>
                        <a href="/books" class="links {{ (Request::is('books*') ? 'actived' : '') }}">Books</a>
                        <a href="/categories" class="links {{ (Request::is('categories*') ? 'actived' : '')}} 
                            {{ (Request::is('category*') ? 'actived' : '') }}">
                            Categories
                        </a>
                        <a href="/list-books" class="links {{ (Request::is('list-books*') ? 'actived' : '') }}">List Book</a>
                        <a href="/users" class="links {{ (Request::is('users*') ? 'actived' : '') }}">User</a>
                        <a href="/rent-logs" class="links {{ (Request::is('rent-logs*') ? 'actived' : '') }}">Rent Log</a>
                        <a href="/book-rents" class="links {{ (Request::is('book-rents*') ? 'actived' : '') }}">Book Rent</a>
                        <a href="/book-return" class="links {{ (Request::is('book-return*') ? 'actived' : '') }}">Book Return</a>
                        <a href="/logout" class="links {{ (Request::is('logout*') ? 'actived' : '') }}">Logout</a>
                    @else
                        <a href="/profile" class="links {{ (Request::is('profile*') ? 'actived' : '') }}">Profile</a>
                        <a href="/list-books" class="links {{ (Request::is('list-books*') ? 'actived' : '') }}">List Book</a>
                        <a href="/logout" class="links {{ (Request::is('logout*') ? 'actived' : '') }}">Logout</a>
                    @endif
            </div>
            <div class="content col-lg-9 p-4">
                @yield('content')
            </div>
        </div>
    </div>
</div>
