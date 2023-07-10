<script>
    $(document).ready(function() {
        $('.sweet_daleteBtn_noForm').on('click', function(e) {
            var formid = $(this).attr('id');
            //alert(formid);
            Swal.fire({
                title: '{!! __('admin/alertMass.sweet_title') !!}',
                text: "{!! __('admin/alertMass.sweet_text') !!}",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{!! __('admin/alertMass.sweet_confirmButtonText') !!}',
                cancelButtonText: '{!! __('admin/alertMass.sweet_cancelButtonText') !!}'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = formid ;
                }
            })
        });
    })
</script>
