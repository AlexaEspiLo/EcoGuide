@extends('layouts.app')
@section('title', $tip->title . ' - Tip')
@section('content')
    <div class="tip-detail-container" style="background-image: url('/images/bg-home.jpeg')">

        <a href="{{ url()->previous() ?: route('home') }}" class="back-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" viewBox="0 0 16 16">
                <path
                    d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
            </svg>
        </a>

        <a href="{{ route('users.show', $tip->user->id) }}" class="author-info">
            <img src="{{ $tip->user->avatar
        ? asset('storage/' . $tip->user->avatar)
        : asset('images/placeholder_user.png') }}" alt="author" class="author-avatar">

            <span class="author-name" style="color: #f8f7f2; font-size: 1.1rem;">
                {{ $tip->user->name }}
            </span>
        </a>

        <div class="tip-detail-card">
            <h1 class="tip-title">{{ $tip->title }}</h1>
            <div class="description">
                <p class="tip-description">{{ $tip->description }}</p>
                <a href="{{ asset('storage/' . $tip->image) }}" data-fancybox data-caption="Tip Image">
                    <img class="tip-image" src="{{ asset('storage/' . $tip->image) }}" alt="Single image">
                </a>
            </div>

            <div class="tip-detail-footer">
                <span id="heart{{$tip->id}}"
                    style="color: {{ $tip->isLikedByLoggedInUser() ? '#354024' : 'var(--beige)' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                        class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                    </svg>
                </span>
                <span class="likes-count">{{ number_format($tip->likes->count()) }}</span>
            </div>
        </div>
    </div>
@endsection