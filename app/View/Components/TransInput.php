<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TransInput extends Component
{
    public $label ;
    public $name ;
    public $reqname ;
    public $value ;
    public $dir ;
    public $newreqname ;
    public $reqspan ;
    public $placeholder ;
    public $placeholderPrint ;
    public function __construct(
        $label=null,
        $name,
        $reqname,
        $value,
        $dir="null",
        $newreqname = "",
        $placeholderPrint = "",
        $placeholder = false,
        $reqspan = true,
    )
    {
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->reqname = $reqname;
        $this->dir = $dir;
        $this->reqspan = $reqspan;

        $this->newreqname =  trim(str_replace('_', " ", $this->reqname)) ;

        $this->placeholder = $placeholder;
        if($this->placeholder == true){
            $this->placeholderPrint = $this->label;
        }


    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.trans-input');
    }
}
