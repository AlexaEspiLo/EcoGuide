@extends('layouts.auth')

@section('content')
    <div class="auth-container">
        <div class="auth-box">
            <img src="{{ asset('images/logo_ecoguide.png') }}" alt="EcoGuide Logo" class="logo">
            <h1 class="auth-title">Explore new ways to care for the planet</h1>

            <form method="POST" action="{{ route('register.post') }}">
                @csrf
                <div class="input-group">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="Full Name" required>
                </div>

                <div class="input-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="example@urbangreen.es" required class="form-control">
                    @error('email')
                        <div class="text-danger mt-1" style="color: red">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="input-group">
                    <div class="password-wrapper">
                        <label>Password</label>
                        @error('password')
                        <div class="text-danger mt-1" style="color: red">
                            {{ $message }}
                        </div>
                    @enderror
                        <small class="text-muted">
                            The password must contain at least 12 characters.
                        </small>

                        <div class="password-field">
                            <input type="password" name="password" id="password" placeholder="********" required>

                            <img src="{{ asset('icons/eye-hidden-icon.png') }}" class="password-toggle-icon"
                                onclick="toggleInput('password', this)">
                        </div>
                    </div>
                </div>

                <div class="input-group">
                    <div class="password-wrapper">
                        <label>Confirm Password</label>
                        <div class="password-field">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                placeholder="********" required style="width: 100%;">
                            <img src="{{ asset('icons/eye-hidden-icon.png') }}" class="password-toggle-icon"
                                onclick="toggleInput('password_confirmation', this)">
                        </div>

                    </div>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="privacy_accepted" id="privacy_accepted" value="1"
                        required>

                    <label class="form-check-label" for="privacy_accepted">
                        I have read and accept the
                        <a href="{{ route('page.show', 'privacy-policy') }}" target="_blank">
                            Privacy Police
                        </a>
                    </label>
                </div>

                <button type="submit" class="btn-primary">Join</button>
            </form>

            <div class="auth-options">
                <a href="{{ route('login') }}" class="login-link">I already have an account</a><br>
                <span class="divider">or</span>

                <a href="{{ url('/auth/google') }}" class="btn-google"
                    style="text-decoration: none; display: flex; align-items: center; justify-content: center; border: 1px solid #354024; border-radius: 20px; padding: 10px; color: #354024;">
                    <img src="{{ asset('icons/google-icon.png') }}" alt="" style="margin-right: 10px; width: 20px;">
                    Register with a Google account
                </a>
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