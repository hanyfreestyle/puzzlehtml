<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SweetDeleteButton extends Component
{

    public $row ;
    public $routeName ;
    public $sweetOff ;

    public function __construct(
        $row = array(),
        $routeName,
        $sweetOff = false,
    )
    {
        $this->row = $row ;
        $this->routeName = $routeName ;
        $this->sweetOff = $sweetOff ;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sweet-delete-button');
    }
}
