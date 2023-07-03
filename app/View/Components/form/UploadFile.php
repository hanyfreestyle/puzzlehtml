<?php

namespace App\View\Components\form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UploadFile extends Component
{

    public $rowCol;
    public $fileName;
    public $label;
    public $labelPhoto;
    public $viewType;
    public $req;
    public $rowData;
    public $fildName;

    public function __construct(
        $rowCol = 'col-6',
        $fileName = 'image',
        $label = '',
        $labelPhoto = null,
        $viewType = null ,
        $req = true ,
        $rowData = array(),
        $fildName = 'photo',

    )
    {
        $this->rowCol = $rowCol;
        $this->fileName = $fileName;
        $this->labelPhoto = __('general.form.currentPhoto');
        $this->label = __('general.form.PhotoUpload');
        $this->viewType = $viewType;
        $this->req = $req;
        $this->rowData = $rowData;
        $this->fildName = $fildName;


        if($this->viewType == 'Edit'){
            $this->req = false;
        }

    }


    public function render(): View|Closure|string
    {
        return view('components.form.upload-file');
    }
}
