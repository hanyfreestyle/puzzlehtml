<?php

namespace App\View\Components\script;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SweetDeleteJsCode extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return <<<'blade'
 <script>
        $( document ).ready(function() {
            @if(Session::has('success_stop') )
            Swal.fire(
                'The Internet?',
                '{{Session::get('success')}}',
                'question'
            )
            @endif
            $('.sweet_daleteBtn_class').on('click', function(e) {

                var formid = $(this).attr('id');

                /// alert(formid);
                Swal.fire({
                    title: '{{__('general.sweet_title')}}',
                    text: "{{__('general.sweet_text')}}",
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{__('general.sweet_confirmButtonText')}}',
                    cancelButtonText: '{{__('general.sweet_cancelButtonText')}}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#thisForId_'+formid).submit();
                    }
                })
            });
        })
    </script>
blade;
    }
}
