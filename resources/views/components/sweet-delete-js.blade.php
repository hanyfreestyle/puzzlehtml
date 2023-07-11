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
                title: '{{__('admin/alertMass.sweet_title') }}',
                text: "{!! htmlspecialchars_decode(__('admin/alertMass.sweet_text')) !!}",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{!! __('admin/alertMass.sweet_confirmButtonText') !!}',
                cancelButtonText: '{!! __('admin/alertMass.sweet_cancelButtonText') !!}'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#thisForId_'+formid).submit();
                }
            })
        });
    })
</script>
