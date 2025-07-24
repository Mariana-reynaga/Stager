<div>
    <a
        class="links.nav-link {{ request()->routeIs($route) ? 'active' : '' }} hover:underline hover:underline-offset-2 hover:decoration-2"
        href="{{ route($route) }}" {!! request()->routeIs($route) ? 'aria-current="page"' : '' !!} >
        {{ $slot }}
    </a>
</div>
