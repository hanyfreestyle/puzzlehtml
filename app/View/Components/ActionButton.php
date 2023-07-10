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
    public $id;
    public $sweetDelClass;

    public function __construct(
        $url = "#",
        $lable = null,
        $size = "s",
        $bg = "p",
        $tip = false,
        $icon = null,
        $type = null,
        $id = null,
        $sweetDelClass = '',

    )
    {
        $this->lable = $lable;
        $this->tip = $tip;
        $this->url = $url;
        $this->icon = $icon;

        $this->size = getButSize($size);
        $this->bg = getBgColor($bg);
        $this->id = $id;
        $this->sweetDelClass = $sweetDelClass;

        if($type){
            switch ($type) {
                case 'add':
                    $this->icon = 'fas fa-plus-square';
                    $this->bg = getBgColor('p');
                    if($this->lable == null){
                        $this->lable = __('admin/form.button_add');
                    }
                    break;

                case 'edit':
                    $this->icon = 'fas fa-pencil-alt';
                    $this->bg = getBgColor('i');
                    if($this->lable == null){
                        $this->lable =__('admin/form.button_edit');
                    }
                    break;

                case 'delete':
                    $this->icon = 'fas fa-trash';
                    $this->bg = getBgColor('d');
                    $this->lable =__('admin/form.button_delete');
                    break;

                case 'deleteSweet':
                    $this->icon = 'fas fa-trash ';
                    $this->bg = getBgColor('d');
                    $this->lable = __('admin/form.button_delete');
                    $this->sweetDelClass = ' sweet_daleteBtn_noForm ';
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
