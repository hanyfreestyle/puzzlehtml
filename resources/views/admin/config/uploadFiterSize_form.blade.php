@extends('admin.layouts.app')
@section('content')
    <x-breadcrumb-def :pageData="$pageData"/>

    <form class="mainForm uploadFilterForm" action="{{route('config.upFilter.size.storeOrUpdate',intval($rowData->id))}}" method="post">
        @csrf
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <x-ui-card title="{{__('admin/config/upFilter.form_main_setting')}}" :add-form-error="true">
                        <input type="hidden" name="filter_id" value="{{$rowData->filter_id}}">

                        <div class="row">
                            <x-form-select-arr  label="{{__('admin/config/upFilter.form_type')}}" name="type" colrow="col-lg-7"
                                                sendvalue="{{old('type',$rowData->type)}}" :send-arr="$filterTypeArr"
                            />
                        </div>

                        <div class="row">
                            <x-form-input label="{{__('admin/config/upFilter.form_new_w')}}" name="new_w" :requiredSpan="true"   colrow="col-lg-4"
                                          value="{{old('new_w',$rowData->new_w)}}" inputclass="dir_en"/>
                            <x-form-input label="{{__('admin/config/upFilter.form_new_h')}}" name="new_h" :requiredSpan="true"   colrow="col-lg-4"
                                          value="{{old('new_h',$rowData->new_h)}}" inputclass="dir_en"/>
                            <x-form-input-color name="canvas_back" label="{{__('admin/config/upFilter.form_canvas_back')}}" value="{{old('canvas_back',$rowData->canvas_back)}}" />
                        </div>

                        <div class="row">
                            <x-form-select-arr  label="{{__('admin/config/upFilter.form_more_setting')}}" name="get_more_option" colrow="col-lg-4"
                                                sendvalue="{{old('get_more_option',$rowData->get_more_option)}}" select-type="selActive" />

                            <x-form-select-arr  label="{{__('admin/config/upFilter.form_text_state')}}" name="get_add_text" colrow="col-lg-4"
                                                sendvalue="{{old('get_add_text',$rowData->get_add_text)}}" select-type="selActive"/>

                            <x-form-select-arr  label="{{__('admin/config/upFilter.form_watermark_state')}}" name="get_watermark" colrow="col-lg-4"
                                                sendvalue="{{old('get_watermark',$rowData->get_watermark)}}" select-type="selActive"/>

                        </div>

                        <div class="container-fluid">
                            <x-form-submit text="{{$pageData['ViewType']}}" />
                        </div>
                    </x-ui-card>

                </div>
            </div>
        </div>
    </form>
@endsection
