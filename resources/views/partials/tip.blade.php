<div class="cards">
    <div class="header-card">
        <h3 class="title-card">{{ $tip->title }}</h3>
        <img src="{{ asset($tip->category->image) }}" class="category-img" alt="category">
    </div>

    <div class="card-author">
        <img src="{{ $tip->user->avatar
    ? asset('storage/' . $tip->user->avatar)
    : asset('images/placeholder_user.png') }}" class="author-img" alt="Avatar Usuario">
        <a href="{{ route('users.show', $tip->user->id) }}" class="author-name">
            {{ $tip->user->name }}
        </a>
    </div>

    <p class="card-description">{{ Str::limit($tip->description, 80) }}</p>

    <div class="footer-card">
        <button type="button" class="more open-tip-modal" data-tip-id="{{ $tip->id }}" data-title="{{ $tip->title }}"
            data-author-url="{{ route('users.show', $tip->user->id) }}" data-description="{{ $tip->description }}"
            data-author="{{ $tip->user->name }}"
            data-avatar="{{ $tip->user->avatar ? asset('storage/' . $tip->user->avatar) : asset('images/placeholder_user.png') }}"
            data-image="{{ $tip->image ? asset('storage/' . $tip->image) : '' }}"
            data-likes="{{ number_format($tip->likes->count()) }}"
            data-comments-count="{{ $tip->comments->count() }}">
            {{ __('messages.see-tip') }}
        </button>
        <div class="tipss">
            <div class="like-section" id="{{$tip->id}}" style="cursor: pointer;">
                <span id="count{{$tip->id}}" class="likes-count">
                    {{ number_format($tip->likes->count()) }}
                </span>
                <span id="heart{{$tip->id}}" class="heart {{ $tip->isLikedByLoggedInUser() ? 'liked' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                    </svg>
                </span>
            </div>
            <div class="comment-btn open-comments-modal" style="cursor: pointer;" data-tip-id="{{ $tip->id }}">
                <span class="comment-count">
                    {{ $tip->comments->count() }}
                </span>
                <span class="comment-svg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                        class="bi bi-chat-dots-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 8c0 3.866-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7M5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0m4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                    </svg>
                </span>
            </div>
            <button type="button" class="share-section" data-title="{{ e($tip->title) }}"
                data-description="{{ e(Str::limit($tip->description, 180)) }}" data-url="{{ url('/tip/' . $tip->id) }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                    class="bi bi-share-fill" viewBox="0 0 16 16">
                    <path
                        d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.5 2.5 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5" />
                </svg>
            </button>
        </div>

    </div>
</div>