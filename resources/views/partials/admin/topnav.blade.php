<nav class="navbar">
    <div class="nav-container">
        <div class="logo">
            <img src="{{ asset('images/logo_ecoguide.png') }}" alt="EcoGuide Logo">
        </div>

        <ul class="nav-center">
            @auth
                <li class="nav-links">
                    <a href="{{ route('admin.categories') }}" class="{{ request()->routeIs('admin.categories') ? 'active' : '' }}">Categories</a>
                </li>
                <li class="nav-links">
                    <a href="{{ route('admin.tips') }}" class="{{ request()->routeIs('admin.tips') ? 'active' : '' }}">Tips</a>
                </li>
                <li class="nav-links">
                    <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">Users</a>
                </li>
                <li class="nav-links">
                    <a href="{{ route('admin.pages') }}" class="{{ request()->routeIs('admin.pages') ? 'active' : '' }}">Info-pages</a>
                </li>
                <li class="nav-links">
                    <a href="{{ route('admin.account') }}" class="{{ request()->routeIs('admin.account') ? 'active' : '' }}">Account</a>
                </li>
            @endauth
        </ul>

    </div>
</nav>