<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class comisionDetailsTitle extends Component
{
    public string $title;
    public string $route;
    public int $status;
    public int $param;

    /**
     * Create a new component instance.
     */
    public function __construct(string $title, string $route, int $status, int $param)
    {
        $this->title = $title;
        $this->route = $route;
        $this->status = $status;
        $this->param = $param;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.com_elements.comision-details-title');
    }
}
