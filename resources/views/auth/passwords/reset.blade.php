@extends('layouts.auth')

@section('content')
<style>
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        width: 100%;
        padding: 20px;
    }
    .glass-panel {
        background-color: rgba(144, 161, 126, 0.85); 
        padding: 3rem; 
        border-radius: 40px;
        width: 100%;
        max-width: 450px; /* Evita que la tarjeta se deforme en pantallas grandes */
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }
    .welcome-title {
        font-family: var(--font-serif-title); /* Usa tu fuente Ahsing */
        color: white; 
        font-style: italic; 
        text-align: center; 
        margin-bottom: 0.5rem;
    }
    .field-label {
        color: var(--dk-green); /* Usa tu variable de verde oscuro */
        font-weight: bold; 
        font-size: 0.8rem;
        display: block;
        margin-bottom: 0.4rem;
    }
    .input-wrapper {
        border-bottom: 2px solid var(--dk-green); 
        padding: 5px 0;
    }
    .input-wrapper input {
        width: 100%; 
        background: transparent; 
        border: none; 
        color: var(--dk-green); 
        outline: none;
        font-family: var(--font-serif-field); /* Usa tu fuente Cormorant Garamond */
        font-size: 1.1rem;
    }
    .input-wrapper input::placeholder {
        color: rgba(53, 64, 36, 0.5);
    }
    .sign-in-btn {
        background: var(--tan); /* Usa tu variable de color Tan */
        border: none; 
        padding: 1rem; 
        border-radius: 50px; 
        width: 100%; 
        font-weight: bold; 
        color: var(--cafe-noir); /* Usa tu variable de café oscuro */
        cursor: pointer;
        font-family: var(--font-sans-body);
        transition: filter 0.2s;
    }
    .sign-in-btn:hover {
        filter: brightness(0.9);
    }
</style>

<div class="login-container">
    <div class="glass-panel">
        <h1 class="welcome-title">New Password</h1>
        <p style="color: white; text-align: center; margin-bottom: 2rem; font-size: 0.95rem;">Set your new secure password below</p>

        <form method="POST" action="{{ route('password.update') }}" class="login-form">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div style="margin-bottom: 1.5rem;">
                <label class="field-label">Email Address</label>
                <div class="input-wrapper">
                    <input type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                </div>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label class="field-label">New Password</label>
                <div class="input-wrapper">
                    <input type="password" name="password" placeholder="********" required>
                </div>
            </div>

            <div style="margin-bottom: 2rem;">
                <label class="field-label">Confirm New Password</label>
                <div class="input-wrapper">
                    <input type="password" name="password_confirmation" placeholder="********" required>
                </div>
            </div>

            <button type="submit" class="sign-in-btn">
                RESET PASSWORD
            </button>
        </form>
    </div>
</div>
@endsection