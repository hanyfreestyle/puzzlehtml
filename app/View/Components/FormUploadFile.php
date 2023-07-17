<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormUploadFile extends Component
{
    public $rowCol;
    public $fileName;
    public $label;
    public $labelPhoto;
    public $viewType;
    public $req;
    public $rowData;
    public $fildName;
    public $multiple;
    public $acceptFile;
    public $thisfilterid;
    public $emptyphotourl;

    public function __construct(
        $rowCol = 'col-6',
        $fileName = 'image',
        $label = '',
        $labelPhoto = null,
        $viewType = null ,
        $req = true ,
        $rowData = array(),
        $fildName = 'photo_thum_1',
        $multiple = false,
        $acceptFile = "image/*",# image/*,.zip
        $thisfilterid = '',
        $emptyphotourl = '#',

    )
    {
        $this->rowCol = $rowCol;
        $this->fileName = $fileName;
        $this->labelPhoto = __('admin/def.form_currentPhoto');
        $this->label = __('admin/def.form_PhotoUpload');
        $this->viewType = $viewType;
        $this->req = $req;
        $this->rowData = $rowData;
        $this->fildName = $fildName;
        $this->multiple = $multiple;
        $this->acceptFile = $acceptFile;
        $this->thisfilterid = $thisfilterid;
        $this->emptyphotourl = $emptyphotourl;


        if($this->viewType == 'Edit'){
            $this->req = false;
        }

    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-upload-file');
    }
}
