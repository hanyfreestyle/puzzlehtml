<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AlertMassage extends Component
{
    public $type ;
    public $bg ;
    public $align ;
    public $mass ;

    public function __construct(
        $type = null,
        $bg = "p",
        $align = 'c',
        $mass = 'Text',

    )
    {
        $this->type = $type;
        $this->bg = getBgColor($bg);
        $this->align = getAlign($align);
        $this->mass = $mass;


        if($type){
            switch ($type) {
                case 'nodata':
                    $this->bg = getBgColor('d');
                    $this->mass = __('admin/alertMass.noData');
                    /*
                    $this->icon = 'fas fa-pencil-alt';
                    $this->bg = getBgColor('i');

                    */
                    break;
                case 'delete':
                    /*
                    $this->icon = 'fas fa-trash';
                    $this->bg = getBgColor('d');
                    $this->lable = __('general.buttonAction.delete');
                    */
                    break;
            }
        }

    }


    public function render(): View|Closure|string
    {
        return view('components.alert-massage');
    }
}
