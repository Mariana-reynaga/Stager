<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class navLinkParam extends Component
{
    public string $route;
    public string $param;
    public int $paramValue;

    /**
     * Create a new component instance.
     */
    public function __construct( string $route, string $param, int $paramValue )
    {
        $this->route = $route;
        $this->param = $param;
        $this->paramValue = $paramValue;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.links.nav-link-param');
    }
}
