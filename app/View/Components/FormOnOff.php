<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormOnOff extends Component
{
    public $name;
    public $label;
    public $value;
    public $colrow;
    public function __construct(
        $name ="",
        $label = "",
        $value = "",
        $colrow = "col-lg-6",


    )
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->colrow = $colrow;
    }


    public function render(): View|Closure|string
    {
        return view('components.form-on-off');
    }
}
