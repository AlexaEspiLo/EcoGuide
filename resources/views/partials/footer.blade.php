<footer class="footer">
    <ul class="footer-links">
        @foreach($pages as $page)
            @if(Route::has('page.show'))
                <li>
                    <a href="{{ route('page.show', $page->slug) }}">
                        {{ $page->title }}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</footer>