@extends('layouts.app')

@section('title', $tip->title . ' - Tip')

@section('content')
    <main class="single-tip-page">

        <section class="single-tip-card">

            <div class="single-tip-info">

                <span class="single-tip-category">
                    {{ $tip->category->category_name }}
                </span>

                <h1 class="single-tip-title">
                    {{ $tip->title }}
                </h1>

                <div class="single-tip-line"></div>

                <p class="single-tip-description">
                    {{ $tip->description }}
                </p>

            </div>

            @if($tip->image)
                <a href="{{ asset('storage/' . $tip->image) }}" data-fancybox data-caption="Tip Image"
                    class="single-tip-image-link">

                    <img class="single-tip-image" src="{{ asset('storage/' . $tip->image) }}" alt="Tip image">
                </a>
            @else
                <div class="single-tip-no-image">
                </div>
            @endif

            <div class="single-tip-bottom">

                <a href="{{ route('users.show', $tip->user->id) }}" class="single-tip-author">
                    <img src="{{ $tip->user->avatar
        ? asset('storage/' . $tip->user->avatar)
        : asset('images/placeholder_user.png') }}" alt="Author">

                    <div>
                        <span>Author</span>
                        <strong>{{ $tip->user->name }}</strong>
                    </div>
                </a>

                <div class="single-tip-actions">

                    <div class="like-section" id="{{ $tip->id }}" style="cursor: pointer;">
                        <span id="heart{{ $tip->id }}" class="heart {{ $tip->isLikedByLoggedInUser() ? 'liked' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                                viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                            </svg>
                        </span>

                        <span id="count{{ $tip->id }}" class="likes-count">
                            {{ number_format($tip->likes->count()) }}
                        </span>
                    </div>

                    <div class="single-comment-indicator">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path
                                d="M16 8c0 3.866-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7" />
                        </svg>

                        <span>{{ $tip->comments->count() }}</span>
                    </div>

                    <button type="button" class="share-section" data-title="{{ e($tip->title) }}"
                        data-description="{{ e(Str::limit($tip->description, 180)) }}"
                        data-url="{{ url('/tip/' . $tip->id) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path
                                d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.5 2.5 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5" />
                        </svg>
                    </button>

                </div>

            </div>

        </section>

        <section class="single-comments-card">

            <div class="single-comments-header">
                <h2>
                    {{ __('messages.comments') }}
                    ({{ $tip->comments->count() }})
                </h2>
            </div>

            @auth
                <form action="{{ route('comments.store', $tip->id) }}" method="POST" class="single-comment-form">
                    @csrf

                    <textarea name="content" placeholder="{{ __('messages.write-comment') }}" maxlength="500"
                        required></textarea>

                    <button type="submit">
                        {{ __('messages.comment') }}
                    </button>
                </form>
            @else
                <p class="login-comment-message">
                    {{ __('messages.login-to-comment') }}
                </p>
            @endauth

            <div class="single-comments-list">
                @forelse($tip->comments()->with('user')->latest()->get() as $comment)
                        <div class="single-comment-item">

                            <img class="single-comment-avatar" src="{{ $comment->user->avatar
                    ? asset('storage/' . $comment->user->avatar)
                    : asset('images/placeholder_user.png') }}" alt="User">

                            <div class="single-comment-body">

                                <div class="single-comment-meta">
                                    <strong>{{ $comment->user->name }}</strong>
                                    <span>{{ $comment->created_at->diffForHumans() }}</span>
                                </div>

                                <p>{{ $comment->content }}</p>

                                @if(auth()->check() && auth()->id() === $comment->user_id)
                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                        class="single-delete-comment-form">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit">
                                            {{ __('messages.delete') }}
                                        </button>
                                    </form>
                                @endif

                            </div>

                        </div>
                @empty
                    <p class="no-comments">
                        {{ __('messages.no-comments') }}
                    </p>
                @endforelse
            </div>

        </section>

    </main>
@endsection