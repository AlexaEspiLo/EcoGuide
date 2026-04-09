@extends('layouts.auth')

@section('content')
<div class="auth-container">
    <div class="auth-box">
        <img src="{{ asset('images/logo_ecoguide.png') }}" alt="EcoGuide Logo" class="logo">
        
        <h1 class="auth-title">Explore new ways to care for the planet</h1>
        @if ($errors->any())
                <div style="color: #721c24; background: #f8d7da; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 0.8rem; text-align: center;">
                    {{ $errors->first() }}
                </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="example@urbangreen.es" value="{{ old('email') }}" required>
            </div>

            <div class="input-group">
                 <div class="password-wrapper">
                    <label>Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <img src="{{ asset('icons/eye-hidden-icon.png') }}" alt="Toggle Password" id="togglePassword" class="password-toggle-icon">
                </div>
            </div>

            <button type="submit" class="btn-primary">Sign In</button>
        </form>

        <div class="auth-options">
            <button class="btn-google">
                <img src="{{ asset('images/google-icon.png') }}" alt=""> Enter with a Google account
            </button>
            
            <a href="{{ route('register') }}" class="btn-outline">Create new Account</a>
            
            <a href="#" class="forgot-link">Forgot password?</a>
        </div>
    </div>
</div>
@endsection