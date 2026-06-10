<div class="language-switcher">
    <a href="{{ route('lang.change', 'en') }}"
       class="lang-btn {{ app()->getLocale() == 'en' ? 'active-lang' : '' }}">
        🇺🇸 EN
    </a>

    <a href="{{ route('lang.change', 'es') }}"
       class="lang-btn {{ app()->getLocale() == 'es' ? 'active-lang' : '' }}">
        🇲🇽 ES
    </a>
</div>