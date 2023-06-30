<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormInputColor extends Component
{
    public $name;
    public $label;
    public $value;
    public function __construct(
        $name ="",
        $label = "",
        $value = "",

    )
    {
            $this->name = $name;
            $this->label = $label;
            $this->value = $value;
    }


    public function render(): View|Closure|string
    {
        return view('components.form-input-color');
    }
}
