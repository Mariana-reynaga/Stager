<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class editTextArea extends Component
{
    public string $colName;
    public string $labelTitle;
    public string $labelTagline;
    public int $maxlength;

    /**
     * Create a new component instance.
     */
    public function __construct(string $colName, string $labelTitle,string $labelTagline, int $maxlength)
    {
        $this->colName = $colName;
        $this->labelTitle = $labelTitle;
        $this->labelTagline = $labelTagline;
        $this->maxlength = $maxlength;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.new-text-area');
    }
}
