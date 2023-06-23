<?php
namespace App\View\Components;

use Illuminate\View\Component;

class BreadcrumbDef extends Component
{
    public $pageData = array();


    public function __construct(

        $pageData = array()

    )
    {
        $this->pageData = $pageData;


    }


    public function render()
    {
        return view('components.breadcrumb-def');
    }
}
