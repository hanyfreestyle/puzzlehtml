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
    public $printLable;

    public function __construct(
        $url = "#",
        $lable = "",
        $size = "s",
        $bg = "p",
        $tip = false,
        $icon = null,
        $type = null,
        $id = null,
        $sweetDelClass = '',
        $printLable = ''

    )
    {
       //  dd($printLable);
        $this->printLable = $printLable;
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
                    $this->printLable = __('admin/form.button_add');
                    break;

                case 'edit':
                    $this->icon = 'fas fa-pencil-alt';
                    $this->bg = getBgColor('i');
                    $this->printLable =__('admin/form.button_edit');
                    break;

                case 'delete':
                    $this->icon = 'fas fa-trash';
                    $this->bg = getBgColor('d');
                    $this->printLable =__('admin/form.button_delete');
                    break;

                case 'deleteSweet':
                    $this->icon = 'fas fa-trash ';
                    $this->bg = getBgColor('d');
                    $this->printLable = __('admin/form.button_delete');
                    $this->sweetDelClass = ' sweet_daleteBtn_noForm ';
                    break;

                case 'force':
                    $this->icon = 'fas fa-trash';
                    $this->bg = getBgColor('d');
                    $this->printLable =__('admin/page.del_force');
                    break;

                case 'restor':
                    $this->icon = 'fas fa-redo';
                    $this->bg = getBgColor('p');
                    $this->printLable =__('admin/page.del_restor');
                    break;

                case 'morePhoto':
                    $this->icon = 'fas fa-images';
                    if(isset($bg)){
                        $this->bg = getBgColor($bg);
                    }else{
                        $this->bg = getBgColor('p');
                    }

                    $this->printLable =__('admin/form.button_more_photo');
                    break;

                default:

            }
        }else{
           // $this->lable = $lable;
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
