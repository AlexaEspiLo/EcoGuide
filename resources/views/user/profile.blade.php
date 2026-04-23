@extends('layouts.app')
@section('title', 'Account')
@section('content')
<div class="profile-container">

    <div class="banner-top"><img src="{{ asset('images/campo_banner.jpg.jpeg') }}" alt="Banner plantas">
   </div>

    <div class="avatar-wrapper">
        <img src="{{ auth()->user()->avatar? asset('storage/' . auth()->user()->avatar): asset('images/placeholder_user.png') }}" class="avatar-img" alt="Avatar Usuario">

    </div>

    <div class="profile-info-block">
        
       <div class="username-row">
    <h2 class="username">{{ auth()->user()->name ?? 'Usuario' }}</h2>

    <a href="{{ url('/account') }}">
        <svg class="edit-icon" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
        </svg>
    </a>
</div>

       <div class="tabs-container">
    <button class="tab active" onclick="showTab('favorites', this)">
        <svg class="heart-icon" viewBox="0 0 24 24">
            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
        </svg>
        Favorites
    </button>

    <button class="tab" onclick="showTab('my-tips', this)">
        My Tips
    </button>
</div>

   
</div>
 <div class="content-section">
    <div id="favorites" class="tab-content active-content">
        <div class="cards-grid">
            @include('components.fav-tip-card')
        </div>
    </div>

    <div id="my-tips" class="tab-content" style="display: none;">
            @include('components.my-tip-card')
    </div>
@push('scripts')
<script src="{{ asset('js/profile.js') }}"></script>
@endpush
@endsection