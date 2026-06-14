<div class="cards-grid">
    @forelse($my_tips as $tip)
        <div class="cards">
            <div class="header-card">
                <h3 class="title-card">{{ $tip->title }}</h3>
                <img src="{{ asset($tip->category->image) }}" class="category-img" alt="category">
            </div>

            <p class="card-description">{{ Str::limit($tip->description, 80) }}</p>

            <div class="footer-card">
                <button type="button" class="more open-tip-modal" data-title="{{ $tip->title }}"
                    data-author-url="{{ route('users.show', $tip->user->id) }}" data-description="{{ $tip->description }}"
                    data-author="{{ $tip->user->name }}"
                    data-avatar="{{ $tip->user->avatar ? asset('storage/' . $tip->user->avatar) : asset('images/placeholder_user.png') }}"
                    data-image="{{ $tip->image ? asset('storage/' . $tip->image) : '' }}"
                    data-likes="{{ number_format($tip->likes->count()) }}">
                    {{ __('messages.see-tip') }}
                </button>

                <div class="tipss like-section" id="{{$tip->id}}" style="cursor: pointer;">
                    <span id="count{{$tip->id}}" class="likes-count">
                        {{ number_format($tip->likes->count()) }}
                    </span>
                    <span id="heart{{$tip->id}}"
                        style="color: {{ $tip->isLikedByLoggedInUser() ? '#354024' : 'var(--beige)' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                            class="bi bi-heart-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                        </svg>
                    </span>
                    <a href="{{ route('tips.edit', $tip->id) }}" class="edit-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg>
                    </a>
                    @if(auth()->id() === $tip->user_id)
                        <form action="{{ route('tips.destroy', $tip->id) }}" method="POST" class="delete-form"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="delete-btn" title="Delete tip">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                                    class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5" />
                                    <path d="M8 5.5A.5.5 0 0 1 8.5 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5" />
                                    <path d="M11 6a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                    <path
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1z" />
                                </svg>
                            </button>
                        </form>
                    @endif

                </div>
            </div>
        </div>

    @empty
        <div class="empty-message">
            {{ __('messages.no-tips-created') }}
        </div>
    @endforelse
</div>
<div id="deleteModal" class="delete-modal">

    <div class="delete-modal-content">

        <div class="delete-icon">
            🗑️
        </div>

        <h3>{{ __('messages.delete-tip') }}</h3>

        <p>
            {{ __('messages.delete-warning') }}
        </p>

        <div class="delete-modal-buttons">

            <button id="cancelDelete" class="cancel-delete-btn">
                {{ __('messages.cancel') }}
            </button>

            <button id="confirmDelete" class="confirm-delete-btn">
                {{ __('messages.delete') }}
            </button>

        </div>

    </div>

</div>