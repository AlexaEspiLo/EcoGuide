@extends('layouts.auth')

@section('content')
<div class="auth-container">
    <div class="auth-box" style="background-color: rgba(155, 167, 129, 0.85); backdrop-filter: blur(8px); color: white; border: none; max-width: 500px;">
        
        <img src="{{ asset('images/logo_ecoguide.png') }}" alt="EcoGuide Logo" class="logo">
        
        <h1 class="auth-title" style="color: white; text-transform: uppercase; letter-spacing: 2px; font-size: 1.2rem;">
            To sign up, read and agree to our terms
        </h1>
        
        <div class="privacy-content" style="text-align: left; margin: 20px 0; font-size: 0.85rem; line-height: 1.6;">
            <p>We use your information to create an account, show ads and content you might like, and improve our products.</p>
            <br>
            <p>You may choose to provide information about yourself that could have special protections under privacy laws.</p>
            <br>
            <p>You may access, change, or delete your information any time.</p>
            <br>
            <p style="font-weight: bold; border-top: 1px solid rgba(255,255,255,0.3); padding-top: 15px;">
                By signing up, you agree to EcoGuide's Terms and Privacy Policy.
            </p>
        </div>

        <form method="POST" action="{{ route('privacidad.aceptar') }}">
            @csrf
            <button type="submit" class="btn-primary" style="background-color: #dccfb4; color: #354024; border: none; width: 100%;">
                I AGREE
            </button>
        </form>
    </div>
</div>

<style>
    /* Esto asegura que la imagen de las plantas esté de fondo en TODA la pantalla */
    .auth-container {
        background-image: url('{{ asset('images/image_0d7cc0.jpg') }}') !important;
        background-size: cover !important;
        background-position: center !important;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Ajuste para que el texto sea blanco como en tu diseño */
    .auth-title {
        color: white !important;
    }
</style>
@endsection