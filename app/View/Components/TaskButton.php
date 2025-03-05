<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TaskButton extends Component
{
    public string $route;
    public string $param;
    public int $paramValue;
    public int $valueKey;
    public string $inputName;
    public string $classes;
    public string $method;

    /**
     * Create a new component instance.
     */
    public function __construct( string $route, string $param, int $paramValue, int $valueKey, string $inputName, string $classes, string $method)
    {
        $this->route        = $route;
        $this->param        = $param;
        $this->paramValue   = $paramValue;
        $this->valueKey     = $valueKey;
        $this->inputName    = $inputName;
        $this->classes      = $classes;
        $this->method       = $method;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.com_elements.task-button');
    }
}
