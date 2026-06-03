@extends('layouts.app')
@section('title', $user->name)
@section('content')
    <div class="profile-container">

        <div class="banner-top">
            <img src="{{ asset('images/campo_banner.jpg.jpeg') }}">
        </div>

        <div class="avatar-wrapper">
            <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/placeholder_user.png') }}"
                class="avatar-img">
        </div>

        <!-- Info -->
        <div class="profile-info-block">
            <h2 class="username">{{ $user->name }}</h2>
        </div>

        <!-- Tips -->
        <div class="content-section">
            <div class="cards-grid">

                @forelse($user->tips as $tip)
                    <div class="cards">

                        <div class="header-card">
                            <h3 class="title-card">{{ $tip->title }}</h3>
                            <img src="{{ asset('storage/' . $tip->image) }}" class="category-img">
                        </div>

                        <p class="card-description">
                            {{ Str::limit($tip->description, 80) }}
                        </p>

                        <div class="footer-card">
                            <button type="button" class="more open-tip-modal" data-title="{{ $tip->title }}"
                                data-author-url="{{ route('users.show', $tip->user->id) }}"
                                data-description="{{ $tip->description }}" data-author="{{ $tip->user->name }}"
                                data-avatar="{{ $tip->user->avatar ? asset('storage/' . $tip->user->avatar) : asset('images/placeholder_user.png') }}"
                                data-image="{{ $tip->image ? asset('storage/' . $tip->image) : '' }}"
                                data-likes="{{ number_format($tip->likes->count()) }}">
                                See Tip
                            </button>

                            <div class="tipss like-section" id="{{$tip->id}}" style="cursor: pointer;">
                                <span id="count{{$tip->id}}" class="likes-count">
                                    {{ number_format($tip->likes->count()) }}
                                </span>

                                @auth
                                    <span id="heart{{$tip->id}}" class="heart {{ $tip->isLikedByLoggedInUser() ? 'liked' : '' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                                            viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                                        </svg>
                                    </span>
                                @else
                                    <a href="/login" style="color: var(--beige)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                                            class="bi bi-heart-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                                        </svg>
                                    </a>
                                @endauth
                            </div>
                        </div>

                    </div>

                @empty
                    <div class="empty-message">
                        This user hasn't posted any tips yet.
                    </div>
                @endforelse

            </div>
        </div>

    </div>
@endsection