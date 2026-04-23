<div class="grid-container">
    @foreach($tips as $tip)
        <div class="cards">
            <div class="header-card">
                <h3 class="title-card">{{ $tip->title }}</h3>
                <img src="{{ asset('images/category-image.png') }}" class="category-img" alt="category">
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
                <a class="more" href="{{ route('tip.show', $tip->id) }}">See Tip</a>
                <div class="tipss like-section" id="{{$tip->id}}" style="cursor: pointer;">
                    <span id="count{{$tip->id}}" class="likes-count">
                        {{ number_format($tip->likes->count()) }}
                    </span>

                    @auth
                        <span id="heart{{$tip->id}}" class="heart {{ $tip->isLikedByLoggedInUser() ? 'liked' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                                viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                            </svg>
                        </span>
                    @else
                        <a href="/login" style="color: var(--beige)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                                class="bi bi-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                            </svg>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    @endforeach
</div>