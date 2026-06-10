@extends('layouts.auth')

@section('content')
<div class="auth-container">
    <div class="auth-box">

        <img src="{{ asset('images/logo_ecoguide.png') }}" alt="EcoGuide Logo" class="logo">

        <h1 class="auth-title">Verify your email</h1>

        <p>
            We sent a verification link to your email address.
            Please check your inbox before continuing.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="success-message">
                A new verification link has been sent.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <button type="submit" class="btn-primary">
                Resend Verification Email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="btn-outline">
                Logout
            </button>
        </form>

    </div>
</div>
@endsection