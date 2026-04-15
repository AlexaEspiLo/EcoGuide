@extends('layouts.auth')

@section('content')
<div class="login-container">
    <div class="glass-panel" style="background-color: rgba(144, 161, 126, 0.85); padding: 3rem; border-radius: 40px;">
        <h1 class="welcome-title" style="color: white; font-style: italic; text-align: center; margin-bottom: 0.5rem;">New Password</h1>
        <p style="color: white; text-align: center; margin-bottom: 2rem;">Set your new secure password below</p>

        <form method="POST" action="{{ route('password.update') }}" class="login-form">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div style="margin-bottom: 1.5rem;">
                <label class="field-label" style="color: #354024; font-weight: bold; text-transform: uppercase; font-size: 0.8rem;">Email Address</label>
                <div class="input-wrapper" style="border-bottom: 2px solid #354024; padding: 5px 0;">
                    <input type="email" name="email" value="{{ $email ?? old('email') }}" style="width: 100%; background: transparent; border: none; color: #354024; outline: none;" required autofocus>
                </div>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label class="field-label" style="color: #354024; font-weight: bold; text-transform: uppercase; font-size: 0.8rem;">New Password</label>
                <div class="input-wrapper" style="border-bottom: 2px solid #354024; padding: 5px 0;">
                    <input type="password" name="password" style="width: 100%; background: transparent; border: none; color: #354024; outline: none;" placeholder="********" required>
                </div>
            </div>

            <div style="margin-bottom: 2rem;">
                <label class="field-label" style="color: #354024; font-weight: bold; text-transform: uppercase; font-size: 0.8rem;">Confirm New Password</label>
                <div class="input-wrapper" style="border-bottom: 2px solid #354024; padding: 5px 0;">
                    <input type="password" name="password_confirmation" style="width: 100%; background: transparent; border: none; color: #354024; outline: none;" placeholder="********" required>
                </div>
            </div>

            <button type="submit" class="sign-in-btn" style="background: #CFBB99; border: none; padding: 1rem; border-radius: 50px; width: 100%; font-weight: bold; color: #4C3D19; cursor: pointer;">
                RESET PASSWORD
            </button>
        </form>
    </div>
</div>
@endsection