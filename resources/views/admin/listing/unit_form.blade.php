@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"  />
    @if($pageData['ViewType'] == 'Edit')
        <div class="content mb-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-9">
                        <h1 class="def_h1">{{ $Unit->translate('ar')->name }}</h1>
                    </div>
                    <div class="col-3 text-left">
                        <x-action-button url="{{route('unit.More_Photos',$Unit->id)}}" type="morePhoto" :tip="false" bg="dark" />
                    </div>
                </div>
            </div>
        </div>
    @endif

    <x-ui-card :page-data="$pageData"  >
        <x-mass.confirm-massage />

        <form  class="mainForm" action="{{route('unit.update',intval($Unit->id))}}" method="post"  enctype="multipart/form-data">
            @csrf
            <div class="row">
                <x-form-input label="Slug" name="slug" :requiredSpan="true" colrow="col-lg-12 {{getColDir('en')}}"
                              value="{{old('slug',$Unit->slug)}}"  dir="en" inputclass="dir_en"/>
            </div>

            <div class="row">
                <x-form-select-arr name="developer_id" label="{{__('admin/project.developer')}}" :sendvalue="old('developer_id',$Unit->developer_id)" :required-span="true" colrow="col-lg-3 " :send-arr="$Developers"/>
                <x-form-select-arr name="location_id" label="{{__('admin/project.loction')}}" :sendvalue="old('location_id',$Unit->location_id)" :required-span="true" colrow="col-lg-3 " :send-arr="$Locations"/>
                <x-form-select-arr name="property_type" label="{{__('admin/project.property_type')}}" :sendvalue="old('property_type',$Unit->property_type)" :required-span="true" colrow="col-lg-3 " :send-arr="$Property_TypeArr"/>
                <x-form-select-arr name="view" label="{{__('admin/project.view')}}" :sendvalue="old('view',$Unit->view)" :required-span="true" colrow="col-lg-3 " :send-arr="$ListingView_Arr"/>

            </div>

            <div class="row">
                <x-form-input label="Latitude" name="latitude" :requiredSpan="false" colrow="col-lg-3 {{getColDir('en')}}"
                              value="{{old('latitude',$Unit->latitude)}}"  dir="en" inputclass="dir_en"/>

                <x-form-input label="Longitude" name="longitude" :requiredSpan="false" colrow="col-lg-3 {{getColDir('en')}}"
                              value="{{old('longitude',$Unit->longitude)}}"  dir="en" inputclass="dir_en"/>

            </div>


            <div class="row">
                @foreach ( config('app.lang_file') as $key=>$lang )
                    <div class="col-lg-6 {{getColDir($key)}}">
                        <x-trans-input

                            label="{{__('admin/def.form_name_'.$key)}} ({{ $key}})"
                            name="{{ $key }}[name]"
                            dir="{{ $key }}"
                            reqname="{{ $key }}.name"
                            value="{{old($key.'.name',$Unit->translateOrNew($key)->name)}}"
                        />
                        <x-trans-text-area
                            label="{{ __('admin/form.content_'.$key)}} ({{ ($key) }})"
                            name="{{ $key }}[des]"
                            dir="{{ $key }}"
                            reqname="{{ $key }}.des"
                            value="{!! old($key.'.des',$Unit->translateOrNew($key)->des) !!}"
                        />

                    </div>
                @endforeach
            </div>

            <x-meta-tage-filde :body-h1="false" :breadcrumb="false"  :old-data="$Unit" :placeholder="false" />

            <hr>

            <div class="row">
                <x-form-check-active :row="$Unit" lable="{{__('admin/form.is_published')}}" name="is_published" page-view="{{$pageData['ViewType']}}"/>
            </div>

            <hr>

            <x-form-upload-file view-type="{{$pageData['ViewType']}}" :row-data="$Unit"
                                :multiple="false"
                                thisfilterid="{{ \App\Helpers\AdminHelper::arrIsset($modelSettings,'unit_filterid',0) }}"
                                emptyphotourl="unit.emptyPhoto"  />

            <div class="container-fluid">
                <x-form-submit text="{{$pageData['ViewType']}}" />
            </div>
        </form>

    </x-ui-card>
@endsection


@push('JsCode')
    {{--    <script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>--}}
    {{--    <script>--}}
    {{--        CKEDITOR.config.height = 450;--}}
    {{--        //  CKEDITOR.config.contentsCss = "https://realestate.eg/css/bootstrap.min.css";--}}
    {{--        CKEDITOR.replace('en[des]');--}}
    {{--        CKEDITOR.replace('ar[des]', {--}}
    {{--            contentsLangDirection: 'rtl',--}}
    {{--        });--}}
    {{--    </script>--}}

@endpush
