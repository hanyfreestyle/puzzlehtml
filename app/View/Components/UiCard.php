<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UiCard extends Component
{
    public $bg;
    public $title;
    public $collapsed, $removable, $maximizable, $disabled;
    public $outline, $full;
    public $cardHeaderView;
    public $showIcon;
    public $collapsedStyle;
    public $addButtonRoute ;
    public $addButtonName ;
    public $addFormError ;
    public $titleColor ;

    public function __construct(
        $title,
        $bg = "primary",
        $collapsed = false, $removable = false,
        $maximizable = false, $disabled = false,
        $outline = true, $full = false,
        $cardHeaderView = true,
        $showIcon = false,
        $collapsedStyle = 'collapse',
        $addButtonRoute = '#',
        $addButtonName= null,
        $titleColor= null,
        $addFormError = true
    )
    {
        $this->bg = $bg;
        $this->title = $title;
        $this->collapsed = $collapsed;
        $this->removable = $removable;
        $this->maximizable = $maximizable;
        $this->disabled = $disabled;
        $this->outline = $outline;
        $this->full = $full;
        $this->addFormError = $addFormError ;
        $this->cardHeaderView = $cardHeaderView;
        $this->showIcon = $showIcon;
        if($showIcon){
            $this->collapsedStyle = $collapsedStyle;
        }else{
            $this->collapsedStyle = "collapse_stop";
        }

        if($addButtonName){
            $this->addButtonName = $addButtonName;
        }else{
            $this->addButtonName = __('general.form.button_Add');
        }
        if($titleColor){
            $this->titleColor = $titleColor;
        }else{
            if($this->outline == false){
                $this->titleColor = 'text-light';
            }else{
                $this->titleColor = 'text-'.$bg;
            }


        }




        $this->addButtonRoute = $addButtonRoute;

    }

    public function render()
    {
        return view('components.ui-card');
    }
}
