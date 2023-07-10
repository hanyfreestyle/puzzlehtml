@extends('admin.layouts.app')
@section('content')

    <x-breadcrumb-def :pageData="$pageData"/>
    <x-ui-card title="{{__('admin/menu.setting_icon')}}" :add-form-error="false"  >


        <div class="row">
            <div class="col-lg-12 text-xl-center IconShowDiv">

                <div data-arrow-class="btn-success" class="IconShowIcon"  id="iconpicker_target_show" role="iconpickerX"></div>

            </div>
        </div>




    </x-ui-card>
@endsection

@push('JsCode')
    <script src="{{defAdminAssets('plugins/bootstrap-iconpicker/js/bootstrap-iconpicker.bundle.min.js')}}"></script>
    <script>

        $( document ).ready(function() {
            $('#iconpicker_target_show').iconpicker({
                align: 'center', // Only in div tag
                arrowClass: 'btn-danger',
                arrowPrevIconClass: 'fas fa-arrow-right',
                arrowNextIconClass: 'fas fa-arrow-left',
                cols: 20,
                footer: true,
                header: true,
                icon: 'fa-bomb',
                iconset: 'fontawesome',
                labelHeader: '{0} of {1} pages',
                labelFooter: '{0} - {1} of {2} icons',
                placement: 'bottom', // Only in button tag
                rows: 10,
                search: true,
                searchText: 'Search',
                selectedClass: 'btn-success',
                unselectedClass: ''
            });
        });

    </script>
@endpush

