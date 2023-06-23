<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormInputDate extends Component
{
    public $id, $name, $label, $placeholder;
    public $topclass, $inputclass;
    public $value, $disabled, $required;
    public $format;
    public $requiredSpan ;
    public $horizontalLabel ;

    public function __construct(
        $id, $name = null,
        $label = 'Input Label', $placeholder = null,
        $topclass = null, $inputclass = null,
        $value = null, $disabled = false, $required = false,
        $format = 'YYYY-MM-DD',
        $requiredSpan = true,
        $horizontalLabel =true
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->topclass = $topclass;
        $this->inputclass = $inputclass;
        $this->value = $value;
        $this->required = $required;
        $this->disabled = $disabled;
        $this->format = $format;
        $this->requiredSpan = $requiredSpan;
        $this->horizontalLabel = $horizontalLabel;
    }

    public function render()
    {
        return view('components.form-input-date');
    }
}
