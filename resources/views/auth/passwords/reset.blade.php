@extends('layouts.auth')

@section('content')
    <div class="auth-container">
        <div class="auth-box">
            @include('components.language-switcher')
            <img src="{{ asset('images/logo_ecoguide.png') }}" alt="EcoGuide Logo" class="logo">
            <h1 class="auth-title">{{ __('messages.reset-pswd') }}</h1>


            @if ($errors->any())
                <div
                    style="color: #721c24; background: #f8d7da; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 0.8rem; text-align: center;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="input-group">
                    <label for="email">{{ __('messages.email') }}</label>
                    <input type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                </div>

                <div class="input-group">
                    <div class="password-wrapper">
                        <label>{{ __('messages.new-pswd') }}</label>
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

                <div class="input-group">
                    <div class="password-wrapper">
                        <label>{{ __('messages.confirm-pswd') }}</label>
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

                <button type="submit" class="btn-primary">{{ __('messages.reset-pswd') }}</button>
            </form>
        </div>
    </div>

    <script>
        function toggleInput(id) {
            const input = document.getElementById(id);
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>
@endsection