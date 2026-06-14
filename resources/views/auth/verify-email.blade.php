@extends('layouts.auth')
@section('title', 'Verify Email')
@section('content')
    <div class="auth-container">
        <div class="auth-box">
            @include('components.language-switcher')
            <a href="{{ route('welcome') }}">
                <img src="{{ asset('images/logo_ecoguide.png') }}" alt="EcoGuide Logo" class="logo">
            </a>
            <h1 class="auth-title">{{ __('messages.verify-email') }}</h1>

            <p>
                {{ __('messages.message-sent') }}
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="success-message">
                    {{ __('messages.verification-sent') }}
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <button type="submit" class="btn-primary">
                    {{ __('messages.resend-email') }}
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="btn-outline">
                    {{ __('messages.back') }}
                </button>
            </form>

        </div>
    </div>
@endsection