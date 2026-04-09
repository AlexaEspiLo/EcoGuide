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