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
    public string $colPastData;

    /**
     * Create a new component instance.
     */
    public function __construct(string $colName, string $labelTitle,string $labelTagline, int $maxlength, string $colPastData)
    {
        $this->colName = $colName;
        $this->labelTitle = $labelTitle;
        $this->labelTagline = $labelTagline;
        $this->maxlength = $maxlength;
        $this->colPastData = $colPastData;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.inputs.edit-text-area');
    }
}
