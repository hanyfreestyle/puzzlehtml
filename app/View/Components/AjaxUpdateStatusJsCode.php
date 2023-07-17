<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AjaxUpdateStatusJsCode extends Component
{

    public $url;
    public function __construct(
         $url = '#',
    )
    {
        $this->url = $url ;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ajax-update-status-js-code');
    }
}
