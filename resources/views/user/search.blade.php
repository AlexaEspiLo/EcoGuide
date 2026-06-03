@extends('layouts.app')

@section('content')

    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Search by user, category, or tip">
    </form>
    @if(isset($results))
        <div class="search-results-label" style="padding: 0 20px; margin-bottom: 20px;">
            <p style="color: #666;">Showing results for: <strong>{{ $query }}</strong></p>
        </div>
        <div class="results-container">
            @forelse($results as $tip)
                @include('components.tip-card', ['tip' => $tip])
            @empty
                <p style="text-align: center; padding: 40px;">No tips were found that match your search.</p>
            @endforelse
        </div>
    @else
        @include('components.tip-card')
    @endif
@endsection