<div>
    <a
        class="nav-link {{ request()->routeIs($route) ? 'active' : '' }}"
        href="{{ route($route, [ $param =>$paramValue] ) }}" {!! request()->routeIs($route) ? 'aria-current="page"' : '' !!} >
        {{ $slot }}
    </a>
</div>
