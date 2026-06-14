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
                <li><a href="{{ route('login') }}"><img src="{{ asset('icons/login-icon.png') }}"
                            class="nav-icon">{{ __('messages.login') }}</a>
                </li>
                <li><a href="{{ route('welcome') }}" class="active"><img src="{{ asset('icons/home-icon.png') }}"
                            class="nav-icon">{{ __('messages.home') }}</a></li>
                <li><a href="{{ route('register') }}"><img src="{{ asset('icons/register-icon.png') }}" class="nav-icon">
                        {{ __('messages.register') }}</a></li>
            @endguest

            @auth
                <li class="nav-links account-dropdown">
                    <button type="button" class="account-btn" id="accountBtn">
                        <img src="{{ asset('icons/account-icon.png') }}" class="nav-icon">
                        {{ __('messages.account') }}
                    </button>

                    <div class="account-menu" id="accountMenu">
                        <a href="{{ route('perfil') }}">
                            {{ __('messages.my-account') }}
                        </a>
                        <a href="{{ route('account') }}">
                            {{ __('messages.edit_profile') }}
                        </a>
                        @include('components.language-switcher')

                        <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                            @csrf
                            <button type="submit">
                                {{ __('messages.logout') }}
                            </button>
                        </form>
                    </div>
                </li>
                <li class="nav-links">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        <img src="{{ asset('icons/home-icon.png') }}" class="nav-icon">{{ __('messages.home') }}
                    </a>
                </li>

                <li class="nav-links nav-search-item">
                    <button type="button" class="nav-search-btn" id="navSearchBtn">
                        <img src="{{ asset('icons/search-icon.png') }}" class="nav-icon"> {{ __('messages.search') }}
                    </button>

                    <form action="{{ route('search') }}" method="GET" class="nav-search-form" id="navSearchForm">
                        <input type="text" name="query" class="nav-search-input"
                            placeholder="{{ __('messages.search-tip') }}...">
                    </form>
                </li>
            @endauth
        </ul>

    </div>
</nav>