<nav class="navbar navbar-expand-xl navbar-dark bg-dark" aria-label="Navbar">
    <div class="container-xl">
        <a class="navbar-brand" href="{{ route('home') }}">362</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link link-warning" href="{{ route('products.index') }}">
                        <i class="bi-search"></i> Search
                    </a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link link-warning" href="{{ route('favorites.index') }}">
                            <i class="bi-heart-fill"></i> Favorites
                        </a>
                    </li>
                @endauth
                @foreach($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index', ['category' => $category->slug]) }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link link-warning" href="#"
                           onclick="event.preventDefault(); document.getElementById('logout').submit();">
                            <i class="bi-box-arrow-right"></i> Logout
                            {{ auth()->user()->name }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}" id="logout">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link link-warning" href="{{ route('login') }}">
                            <i class="bi-box-arrow-in-right"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-warning" href="{{ route('register') }}">
                            <i class="bi-person-plus"></i> Register
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
