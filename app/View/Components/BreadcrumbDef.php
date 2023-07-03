<?php
namespace App\View\Components;

use Illuminate\View\Component;

class BreadcrumbDef extends Component
{
    public $pageData = array();
    public $butView ;


    public function __construct(

        $pageData = array(),
        $butView = true ,

    )
    {
        $this->pageData = $pageData;
        $this->butView = $butView ;


    }


    public function render()
    {
        return view('components.breadcrumb-def');
    }
}
