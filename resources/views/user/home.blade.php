@extends('layouts.app')
@section('title', 'Home')
@section('content')

    <section class="hero-home">
        <div id="hero-content" class="hero-content">
            <h1 class="title">{{ __('messages.home-title') }}</h1>
            <h2 class="subtitle">{{ __('messages.home-subtitle') }}</h2>
            <h3 class="text-home">{{ __('messages.home-text') }}</h3>
            <a href="#tipsSection" class="hero-content-btn">
                {{ __('messages.explore') }}
            </a>
        </div>
        <div class="hero-image" id="hero-home">

        </div>
    </section>

    <section id="tipsSection" class="tips-section">
        <div class="categories-wrapper">

            <button class="scroll-btn left" id="scrollLeft">
                ❮
            </button>

            <div class="filters-home" id="categoriesContainer">

                <div class="category active" data-id="all">
                    {{ __('messages.all') }}
                </div>

                @foreach ($categories as $category)
                    <div class="category" data-id="{{ $category->id }}">
                        #{{ str_replace(' ', '', Str::title($category->category_name)) }}
                    </div>
                @endforeach

            </div>

            <button class="scroll-btn right" id="scrollRight">
                ❯
            </button>

        </div>

        <div class="sort-container">

            <div class="custom-select" id="sortSelect">

                <div class="selected-option">
                    {{ __('messages.sort-by') }}
                </div>

                <div class="options-container">

                    <div class="option" data-value="">
                        {{ __('messages.default') }}
                    </div>

                    <div class="option" data-value="newest">
                        {{ __('messages.newest') }}
                    </div>

                    <div class="option" data-value="oldest">
                        {{ __('messages.oldest') }}
                    </div>

                    <div class="option" data-value="most_liked">
                        {{ __('messages.most-liked') }}
                    </div>

                    <div class="option" data-value="title">
                        A-Z
                    </div>

                </div>

            </div>

        </div>

        <div id="tips-container" class="grid-container">
            @foreach($tips as $tip)
                @include('partials.tip', ['tip' => $tip])
            @endforeach
        </div>

        @if($tips->hasMorePages())
            <div class="load-more-container">
                <button id="load-more-btn" data-page="2">
                    {{ __('messages.load-more') }}
                </button>
            </div>
        @endif
    </section>







    <div class="fixed-add-button-container">
        <a href="{{ route('tips.create') }}" class=" fixed-add-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-plus"
                viewBox="0 0 16 16">
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
            </svg>
        </a>
    </div>

@endsection