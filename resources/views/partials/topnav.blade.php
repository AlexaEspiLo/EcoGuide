<nav class="navbar">
    <div class="nav-container">
        <div class="logo">
            <img src="{{ asset('images/logo_ecoguide.png') }}" alt="EcoGuide Logo">
        </div>

        <button class="menu-toggle" id="menuToggle" type="button">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <ul class="nav-center">
            @guest
                <li><a href="{{ route('login') }}"><img src="{{ asset('icons/login-icon.png') }}" class="nav-icon">Login</a>
                </li>
                <li><a href="" class="active"><img src="{{ asset('icons/home-icon.png') }}" class="nav-icon">Home</a></li>
                <li><a href="{{ route('register') }}"><img src="{{ asset('icons/register-icon.png') }}" class="nav-icon">
                        Register</a></li>
            @endguest

            @auth
                <li class="nav-links">
                    <a href="{{ route('perfil') }}" class="{{ request()->routeIs('perfil') ? 'active' : '' }}">
                        <img src="{{ asset('icons/account-icon.png') }}" class="nav-icon"> Account
                    </a>
                </li>

                <li class="nav-links">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        <img src="{{ asset('icons/home-icon.png') }}" class="nav-icon"> Home
                    </a>
                </li>

                <li class="nav-links">
                    <a href="/search" class="{{ request()->path() == 'search' ? 'active' : '' }}">
                        <img src="{{ asset('icons/search-icon.png') }}" class="nav-icon"> Search
                    </a>
                </li>
            @endauth
        </ul>

    </div>
</nav>