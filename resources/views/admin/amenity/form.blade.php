@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"/>

    <x-ui-card :page-data="$pageData">
        <x-mass.confirm-massage />



        <form  class="mainForm" action="{{route('amenity.update',intval($rowData->id))}}" method="post"  enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="view_type" value="{{$pageData['ViewType']}}">
            <div class="col-lg-12">
                <div class="row">
                    @foreach ( config('app.lang_file') as $key=>$lang )
                        <div class="col-lg-6 {{getColDir($key)}}">
                            <x-trans-input

                                label="{{__('admin/def.form_name_'.$key)}} ({{ $key}})"
                                name="{{ $key }}[name]"
                                dir="{{ $key }}"
                                reqname="{{ $key }}.name"
                                value="{{old($key.'.name',$rowData->translateOrNew($key)->name)}}"
                            />
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group col-lg-4" style="direction: ltr!important;">
                <label class="col-form-label font-weight-light " for="">Icon</label>
                <div class="" style="direction: ltr!important;">
                    <input type="hidden" name="icon" id="icon_hidden_filde" value="{{old('icon',$rowData->icon)}}"  >
                    <button class="btn btn-primary"
                            data-align="center"
                            data-icon="{{old('icon',$rowData->icon)}}" id="iconpicker_target" role="iconpicker"></button>
                </div>
            </div>
            <hr>

            <x-form-upload-file view-type="{{$pageData['ViewType']}}" :row-data="$rowData" emptyphotourl="amenity.emptyPhoto" :multiple="false"/>

            <div class="container-fluid">
                <x-form-submit text="{{$pageData['ViewType']}}" />
            </div>
        </form>

    </x-ui-card>
@endsection


@push('JsCode')
    <script src="{{defAdminAssets('plugins/bootstrap-iconpicker/js/bootstrap-iconpicker.bundle.min.js')}}"></script>
    <script>
        $('#iconpicker_target').on('change', function(e) {
            $("#icon_hidden_filde").val(e.icon);
        });
    </script>
@endpush



