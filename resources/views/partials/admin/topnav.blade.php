<nav class="navbar">
    <div class="nav-container">
        <div class="logo">
            <img src="{{ asset('images/logo_ecoguide.png') }}" alt="EcoGuide Logo">
        </div>

            <ul class="nav-center">
                @guest
                    <li><a href="{{ route('categories') }}"><img src="{{ asset('icons/categories-icon.png') }}" class="nav-icon">Categories</a></li>
                @endguest

                <li><a href="{{ route('tips') }}" class="active"><img src="{{ asset('icons/tip-icon.png') }}" class="nav-icon">Tips</a></li>

                @guest
                    <li><a href="{{ route('users') }}"><img src="{{ asset('icons/users-icon.png') }}" class="nav-icon"> Users</a></li>
                @endguest

                @guest
                    <li><a href="{{ route('info-pages') }}"><img src="{{ asset('icons/info-pages-icon.png') }}" class="nav-icon"> Pages</a></li>
                    @endguest

                    @guest
                    <li><a href="{{ route('account') }}"><img src="{{ asset('icons/account-icon.png') }}" class="nav-icon">Account</a></li>
                    @endguest


                @auth
                    
                   
                @endauth
            </ul>

    </div>
</nav>