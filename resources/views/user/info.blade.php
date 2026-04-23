@extends('layouts.app')
@section('title', $page->title)
@section('content')
<div class="about-container" style="background-image: url('{{ asset('/images/info-bg.png') }}');">
    <div class="about-overlay">
        <h1 class="about-title">{{ $page->title }}</h1>
        
        <div class="about-content">
            <p>{{ $page->content }}</p>
        </div>

    </div>
</div>
@endsection