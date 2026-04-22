<footer class="footer">
    <div class="footer-links">
        @foreach($pages as $page)
            @if(Route::has('page.show'))
                <a href="{{ route('page.show', $page->slug) }}">
                    {{ $page->title }}
                </a>
            @endif
        @endforeach
    </div>
</footer>