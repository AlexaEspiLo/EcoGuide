@extends('layouts.app')
@section('title', 'Search')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">

    <div class="search-page">

        <div class="search-header">
            <form action="{{ route('search') }}" method="GET" class="search-form">

                <input type="text" name="query" placeholder="Search users, tips or categories..." value="{{ $query ?? '' }}"
                    class="search-input" autofocus>

                <button type="submit" class="search-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search"
                        viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                </button>

            </form>
        </div>

        <!-- CONTENIDO -->
        <div class="search-content">

            @if(isset($query) && $query != '')

                @if(isset($users) && $users->isNotEmpty())
                    <h3 class="search-title">{{ __('messages.users') }}</h3>

                    <div class="users-grid">
                        @foreach($users as $user)
                            <a href="{{ route('users.show', $user->id) }}" class="user-card">

                                <img src="{{ $user->avatar
                                ? asset('storage/' . $user->avatar)
                                : asset('images/placeholder_user.png') }}" class="user-avatar">

                                <span class="user-name">
                                    {{ $user->name }}
                                </span>

                            </a>
                        @endforeach
                    </div>
                @endif


                {{-- 📌 TIPS --}}
                <h3 class="search-title">{{ __('messages.results') }}</h3>

                @if($tips->isNotEmpty())

                    <div id="tips-container" class="grid-container">
                        @foreach($tips as $tip)
                            @include('partials.tip', ['tip' => $tip])
                        @endforeach
                    </div>

                @else

                    <div class="empty-state">
                        {{ __('messages.no-results') }}
                    </div>

                @endif

            @else
                <div class="empty-state">
                    {{ __('messages.type-to-search') }}
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                        viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                </div>
            @endif

        </div>
    </div>
@endsection