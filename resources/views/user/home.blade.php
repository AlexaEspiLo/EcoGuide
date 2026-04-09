@extends('layouts.app')

@section('content')

<h1 class="title">Sustainable Tips</h1>
<h2 class="subtitle">for Everyday Life</h2>
<p class="subtitle">Small actions can create a big impact</p>

<div class="tips-grid">
    @foreach ($tips as $tip)
        <x-tip-card 
            :title="$tip->title"
            :description="$tip->description"
            :likes="$tip->likes"
            :author="$tip->user->name"
            :id="$tip->id"
        />
    @endforeach
</div>

@endsection