@extends('layouts.auth')

@section('content')
    <div class="auth-container">
        <div class="auth-box">
            @include('components.language-switcher')
            <img src="{{ asset('images/logo_ecoguide.png') }}" alt="EcoGuide Logo" class="logo">
            <h1 class="auth-title">{{ __('messages.login-phrase') }}</h1>

            @if ($errors->any())
                <div
                    style="color: #721c24; background: #f8d7da; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 0.8rem; text-align: center;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group">
                    <label for="email">{{ __('messages.email') }}</label>
                    <input type="email" id="email" name="email" placeholder="example@urbangreen.es"
                        value="{{ old('email') }}" required>
                </div>

                <div class="input-group">
                    <div class="password-wrapper">
                        <label>{{ __('messages.password') }}</label>
                        @error('password')
                            <div class="text-danger mt-1" style="color: red">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="password-field">
                            <input type="password" name="password" id="password" placeholder="********" required>

                            <img src="{{ asset('icons/eye-hidden-icon.png') }}" class="password-toggle-icon"
                                onclick="toggleInput('password', this)">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-primary">{{ __('messages.sign-in') }}</button>
            </form>

            <div class="auth-options">
                <a href="{{ url('/auth/google') }}" class="btn-google"
                    style="text-decoration: none; display: flex; align-items: center; justify-content: center; margin-top: 20px; border: 1px solid #354024; border-radius: 20px; padding: 10px; color: #354024;">
                    <img src="{{ asset('icons/google-icon.png') }}" alt="" style="margin-right: 10px; width: 20px;">
                    {{ __('messages.google-account-in') }}
                </a>

                <div style="margin-top: 15px;">
                    <a href="{{ route('register') }}" class="btn-outline">{{ __('messages.new-account') }}</a>
                </div>

                <a href="{{ route('password.request') }}" class="forgot-link">{{ __('messages.forgot-password') }}</a>
            </div>
        </div>
    </div>

    <script>
        function toggleInput(id) {
            const input = document.getElementById(id);
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>
@endsection