@extends('layouts.app')

@php
    $locale = app()->getLocale();

    $title = $locale === 'en' && !empty($page->title_en)
        ? $page->title_en
        : $page->title;

    $content = $locale === 'en' && !empty($page->content_en)
        ? $page->content_en
        : $page->content;
@endphp

@section('title', $title)

@section('content')
    <div class="about-container">

        <div class="about-overlay">

            <div class="about-card">
                <div class="hero">
                    <div class="hero-tag">EcoGuide</div>

                    <h1>{{ $title }}</h1>

                    <p>{{ __('messages.sustainable-platform') }}</p>
                </div>

                <div class="about-content">
                    {!! $content !!}
                </div>
            </div>

        </div>

    </div>
@endsection