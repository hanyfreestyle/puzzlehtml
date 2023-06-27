<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionButton extends Component
{
    public $lable ;
    public $size ;
    public $bg ;
    public $tip ;
    public $url ;
    public $icon ;
    public $type ;

    public function __construct(
        $url = "#",
        $lable = "but",
        $size = "s",
        $bg = "p",
        $tip = true,
        $icon = null,
        $type = null,


    )
    {
        $this->lable = $lable;
        $this->tip = $tip;
        $this->url = $url;
        $this->icon = $icon;

        $this->size = getButSize($size);
        $this->bg = getBgColor($bg);

        if($type){
            switch ($type) {
                case 'edit':
                    $this->icon = 'fas fa-pencil-alt';
                    $this->bg = getBgColor('i');
                    $this->lable = __('general.buttonAction.edit');
                    break;
                case 'delete':
                    $this->icon = 'fas fa-trash';
                    $this->bg = getBgColor('d');
                    $this->lable = __('general.buttonAction.delete');
                    break;
            }
        }




    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.action-button');
    }
}
