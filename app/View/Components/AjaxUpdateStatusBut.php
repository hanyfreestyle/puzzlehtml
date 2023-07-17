<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AjaxUpdateStatusBut extends Component
{
    public $row ;
    public $class ;
    public $field ;
    public $role ;

    public function __construct(
        $row = array(),
        $class = 'status_but',
        $field = 'is_active',
        $role =null,
    )
    {
        $this->row = $row ;
        $this->class = $class ;
        $this->field = $field ;
        $this->role = $role ;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ajax-update-status-but');
    }
}
