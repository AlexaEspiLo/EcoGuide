<footer class="footer">
    <ul class="footer-links">
        @foreach($pages as $page)
            <li>
                <a href="{{ route('page.show', $page->slug) }}">
                    @if(app()->getLocale() === 'es')
                        {{ $page->title }}
                    @else
                        {{ $page->title_en ?: $page->title }}
                    @endif
                </a>
            </li>
        @endforeach
    </ul>
</footer>