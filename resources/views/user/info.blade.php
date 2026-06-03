@extends('layouts.app')

@section('title', $page->title)

@section('content')
    <div class="about-container">

        <div class="about-overlay">

            <div class="about-card">
                <div class="hero">
                    <div class="hero-tag">EcoGuide</div>
                    <h1>{{ $page->title }}</h1>
                    <p>Sustainable Tips Platform</p>
                </div>
                <div class="about-content">
                    {!! $page->content !!}
                </div>
            </div>

        </div>

    </div>
@endsection