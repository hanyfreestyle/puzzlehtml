<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormSelect2 extends Component
{
    public $id, $name, $label;
    public $topclass, $inputclass;
    public $disabled, $required, $multiple;
    public $requiredSpan ;
    public $horizontalLabel ;

    public function __construct(
        $id, $name = null,
        $label = 'Input Label',
        $topclass = null, $inputclass = null,
        $disabled = false, $required = false, $multiple = false,
        $requiredSpan = true,
        $horizontalLabel = true
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->topclass = $topclass;
        $this->inputclass = $inputclass;
        $this->required = $required;
        $this->disabled = $disabled;
        $this->multiple = $multiple;
        $this->requiredSpan = $requiredSpan ;
        $this->horizontalLabel = $horizontalLabel ;
    }
    public function render()
    {
        return view('components.form-select2');
    }
}
