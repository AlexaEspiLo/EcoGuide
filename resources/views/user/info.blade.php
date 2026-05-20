@extends('layouts.app')

@section('title', $page->title)

@section('content')
<div class="about-container" style="background-image: url('{{ asset('/images/image.png') }}');">

    <div class="about-overlay">

        <div class="about-card">
            <h1 class="about-title">
                {{ $page->title }}
            </h1>

            <div class="about-content">
                {!! $page->content !!}
            </div>
        </div>

    </div>

</div>
@endsection