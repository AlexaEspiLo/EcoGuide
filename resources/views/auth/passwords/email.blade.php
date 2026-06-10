@extends('layouts.auth')

@section('content')
    <div class="auth-container">
        <div class="auth-box">
            @include('components.language-switcher')
            <img src="{{ asset('images/logo_ecoguide.png') }}" alt="EcoGuide Logo" class="logo">
            <h1 class="auth-title" style="margin-bottom: 5px">{{ __('messages.reset-pswd') }}</h1>
            <small class="text-muted">
                {{ __('messages.message-email') }}
            </small> <br> <br>

            @if ($errors->any())
                <div
                    style="color: #721c24; background: #f8d7da; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 0.8rem; text-align: center;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="input-group">
                    <label>{{ __('messages.email') }}</label>
                    <input type="email" name="email" placeholder="example@urbangreen.es" required class="form-control">
                    @error('email')
                        <div class="text-danger mt-1" style="color: red">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn-primary">{{ __('messages.send-reset') }}</button>
            </form>
            <div style="margin-top: 2rem;">
                <a href="{{ route('login') }}"
                    style="color: #354024; text-decoration: none; font-weight: bold; font-size: 0.9rem;">←{{ __('messages.back-login') }}</a>
            </div>
        </div>

    </div>


@endsection