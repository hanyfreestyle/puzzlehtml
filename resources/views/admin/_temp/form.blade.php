@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"/>

    <x-ui-card title="{{$pageData[$pageData['ViewType'].'PageName']}}">
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


            <hr>
            <x-form-select-arr  label="{{__('admin/def.form_selectFilterLable')}}" name="filter_id" colrow="col-lg-6"
                                sendvalue="{{old('filter_id')}}" :send-arr="$filterTypes"/>

            <x-form-upload-file view-type="{{$pageData['ViewType']}}" :row-data="$rowData" :multiple="false"/>

            <div class="container-fluid">
                <x-form-submit text="{{$pageData['ViewType']}}" />
            </div>
        </form>

    </x-ui-card>
@endsection


@push('JsCode')

@endpush



