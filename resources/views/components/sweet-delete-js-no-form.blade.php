<script>
    $(document).ready(function() {
        $('.sweet_daleteBtn_noForm').on('click', function(e) {
            var formid = $(this).attr('id');
            //alert(formid);
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
                    window.location.href = formid ;
                }
            })
        });
    })
</script>
