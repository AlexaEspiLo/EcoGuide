<nav class="navbar">
    <div class="nav-container">
        <div class="logo">
            <img src="{{ asset('images/logo_ecoguide.png') }}" alt="EcoGuide Logo">
        </div>

            <ul class="nav-center">
                @guest
                    <li><a href="{{ route('login') }}"><img src="{{ asset('icons/login-icon.png') }}" class="nav-icon">Login</a></li>
                @endguest

                <li><a href="{{ route('home') }}" class="active"><img src="{{ asset('icons/home-icon.png') }}" class="nav-icon">Home</a></li>

                @guest
                    <li><a href="{{ route('register') }}"><img src="{{ asset('icons/register-icon.png') }}" class="nav-icon"> Register</a></li>
                @endguest

                @auth
                    <li><a href="{{ route('tips.create') }}"><img src="{{ asset('icons/add-icon.png') }}" class="nav-icon"> Add Tip</a>
                    </li>
                    <li><a href="{{ route('home') }}"><img src="{{ asset('icons/account-icon.png') }}" class="nav-icon"> Account</a></li>
                @endauth
            </ul>

        <div class="nav-right">
            <a href="#">
                <img src="{{ asset('icons/search-icon.png') }}" class="nav-icon">
            </a>
        </div>

    </div>
</nav>