<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DefSettings extends Component
{
    public $modelname;

    public function __construct(
        $modelname = "",
    )
    {
        $this->modelname = $modelname;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.def-settings');
    }
}
