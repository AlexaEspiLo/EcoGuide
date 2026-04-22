@extends('layouts.app')

@section('content')

    <section class="hero-home">
    </section>

    <div class="hero-content">
        <h1 class="title">Sustainable Tips</h1>
        <h2 class="subtitle">For Everyday Life</h2>
        <p class="phrase">Small actions can create a big impact</p>
    </div>

    <div class="filters">
        <div class="category active" data-id="all">
            All
        </div>

        @foreach ($categories as $category)
            <div class="category" data-id="{{ $category->id }}">
                #{{ str_replace(' ', '', Str::title($category->category_name)) }}
            </div>
        @endforeach
    </div>

    <div id="tips-container">
        @include('partials.tips', ['tips' => $tips])
    </div>

    <div class="fixed-add-button-container">
        <a href="#" class="fixed-add-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-plus"
                viewBox="0 0 16 16">
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
            </svg>
        </a>
    </div>

@endsection