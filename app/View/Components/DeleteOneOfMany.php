<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteOneOfMany extends Component
{
    public string $title;
    public string $tagline;
    public string $route;
    public string $param;
    public int $paramValue;
    public string $valueName;

    /**
     * Create a new component instance.
     */
    public function __construct(string $title, string $tagline, string $route, string $param, int $paramValue, string $valueName)
    {
        $this->title = $title;
        $this->tagline = $tagline;
        $this->route = $route;
        $this->param = $param;
        $this->paramValue = $paramValue;
        $this->valueName = $valueName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.delete-one-of-many-modal');
    }
}
