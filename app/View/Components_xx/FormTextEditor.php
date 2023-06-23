<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormTextEditor extends Component
{

    public $id, $name, $label, $placeholder;
    public $topclass, $inputclass;
    public $body, $disabled, $required;
    public $height, $fonts;
    public $def_fonts = ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Impact', 'Montserrat',  'Open Sans', 'Ubuntu', 'Rajdhani'];
    public $requiredSpan ;
    public $horizontalLabel ;

    public function __construct(
        $id, $name = null,
        $label = 'Input Label', $placeholder = null,
        $topclass = null, $inputclass = null,
        $body = null, $disabled = false, $required = false,
        $height = 500, $fonts = null,
        $requiredSpan = true,
        $horizontalLabel =false
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->topclass = $topclass;
        $this->inputclass = $inputclass;
        $this->body = $body;
        $this->required = $required;
        $this->disabled = $disabled;
        $this->height = $height;
        $this->fonts = $fonts;
        $this->requiredSpan = $requiredSpan;
        $this->horizontalLabel = $horizontalLabel;
    }

    public function fontarray()
    {
        return $this->fonts == null ? json_encode($this->def_fonts) : $this->fonts;
    }
    public function render()
    {
        return view('components.form-text-editor');
    }
}
