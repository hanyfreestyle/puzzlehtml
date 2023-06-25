<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormTextarea extends Component
{
    public $id, $name, $label, $placeholder;
    public $topclass, $inputclass;
    public $disabled, $required;
    public $rows;
    public $requiredSpan ;
    public $horizontalLabel ;
    public $value;

    public function __construct(
        $id = null, $name = null,
        $label = 'Input Label', $placeholder = null,
        $topclass = null, $inputclass = null,
        $disabled = false, $required = false,
        $rows = '5',
        $requiredSpan = false,
        $value = null,
        $horizontalLabel =false
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->topclass = $topclass;
        $this->inputclass = $inputclass;
        $this->required = $required;
        $this->disabled = $disabled;
        $this->rows = $rows;
        $this->requiredSpan = $requiredSpan;
        $this->horizontalLabel = $horizontalLabel;
        $this->value = $value;
    }

    public function render()
    {
        return view('components.form-textarea');
    }
}
