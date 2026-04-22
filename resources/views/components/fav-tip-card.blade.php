<div class="cards-grid">
    @forelse($favorites as $tip)
        <div class="cards">
            <div class="header-card">
                <h3 class="title-card">{{ $tip->title }}</h3>
                <img src="{{ asset('images/bg-home.jpeg') }}" class="category-img" alt="category">
            </div>

            <div class="card-author">
                <img src="{{ $tip->user->avatar
            ? asset('storage/' . $tip->user->avatar)
            : asset('images/placeholder_user.png') }}" class="author-img" alt="Avatar Usuario"> <span
                    class="author-name">{{ $tip->user->name }}</span>
            </div>

            <p class="card-description">{{ Str::limit($tip->description, 80) }}</p>

            <div class="footer-card">
                <a class="more" href="{{ route('tip.show', $tip->id) }}">See Tip</a>

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
                </div>
            </div>
        </div>

    @empty
        <div class="empty-message">
            There are no favorite tips yet.
        </div>
    @endforelse
</div>