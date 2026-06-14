@extends('layouts.app')

@section('title', 'Welcome')

@section('content')

<section class="welcome-modern">

    <div class="welcome-bg-shape shape-one"></div>
    <div class="welcome-bg-shape shape-two"></div>

    <div class="welcome-modern-content">

        <div class="welcome-copy reveal-up">
            <span class="welcome-eyebrow">EcoGuide @include('components.language-switcher')</span>
            

            <h1>
                {{ __('messages.main-message') }}
            </h1>

            <p>
                {{ __('messages.paragraph') }}
            </p>

            <div class="welcome-actions">
                <a href="{{ route('register') }}" class="welcome-btn primary">
                    {{ __('messages.join-ecoguide') }}
                </a>

                <a href="{{ route('login') }}" class="welcome-btn secondary">
                    {{ __('messages.login') }}
                </a>
            </div>
        </div>

        <div class="welcome-visual reveal-up delay-one">

            <div class="floating-card card-main">
                <span class="card-label">{{ __('messages.featured-tip') }}</span>
                <h3>{{ __('messages.title-tip') }}</h3>
                <p>{{ __('messages.welcome-tip') }}</p>
            </div>

            <div class="floating-card card-small card-top">
                <span class="dot"></span>
                {{ __('messages.category-welcome') }}
            </div>

            <div class="floating-card card-small card-bottom">
                <span class="dot"></span>
                {{ __('messages.category-welcome-2') }}
            </div>

            <div class="organic-circle"></div>

        </div>

    </div>

    <div class="welcome-strip reveal-up delay-two">
        <div>
            <span>01</span>
            {{ __('messages.explore') }}
        </div>

        <div>
            <span>02</span>
            {{ __('messages.save') }}
        </div>

        <div>
            <span>03</span>
            {{ __('messages.share') }}
        </div>
    </div>

</section>

@endsection