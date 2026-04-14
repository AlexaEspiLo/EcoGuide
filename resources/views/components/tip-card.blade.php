<div class="tip-card">
    <h3>{{ $title }}</h3>

    <p>{{ $description }}</p>

    <div class="tip-footer">
        <span>{{ $likes }}</span>
        <span>{{ $author }}</span>
    </div>

    <a href="{{ route('tips.show', $id) }}" class="btn-tip">
        See Tip
    </a>
</div>

<div class="tip-card">

    @if($image)
        <img src="{{ asset('storage/' . $image) }}" class="tip-image">
    @endif

    <h3 class="tip-title">{{ $title }}</h3>

    <p class="tip-description">
        {{ Str::limit($description, 100) }}
    </p>

    <div class="tip-footer">
        <span class="tip-likes">❤️ {{ $likes }}</span>
        <span class="tip-author">{{ $author }}</span>
    </div>

    <a href="{{ route('tips.show', $id) }}" class="btn-tip">
        See Tip
    </a>

</div>