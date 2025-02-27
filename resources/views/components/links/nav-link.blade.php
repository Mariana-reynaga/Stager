<div>
    <a
        class="links.nav-link {{ request()->routeIs($route) ? 'active' : '' }}"
        href="{{ route($route) }}" {!! request()->routeIs($route) ? 'aria-current="page"' : '' !!} >
        {{ $slot }}
    </a>
</div>
