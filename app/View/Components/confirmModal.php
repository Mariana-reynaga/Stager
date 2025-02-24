<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class confirmModal extends Component
{
    public string $title;
    public string $tagline;
    public string $route;
    public string $param;
    public int $paramValue;
    public string $method;
    public string $submitTxt;

    /**
     * Create a new component instance.
     */
    public function __construct(string $title, string $tagline, string $route, string $param, int $paramValue, string $method, string $submitTxt)
    {
        $this->title = $title;
        $this->tagline = $tagline;
        $this->route = $route;
        $this->param = $param;
        $this->paramValue = $paramValue;
        $this->method = $method;
        $this->submitTxt = $submitTxt;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.confirm-modal');
    }
}
