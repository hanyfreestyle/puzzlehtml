@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"/>

    <x-ui-card :page-data="$pageData">
        <x-mass.confirm-massage />

        <form  class="mainForm" action="{{route('location.update',intval($location->id))}}" method="post"  enctype="multipart/form-data">
            @csrf
            <div class="row">
                <x-form-input label="Slug" name="slug" :requiredSpan="true" colrow="col-lg-12 {{getColDir('en')}}"
                              value="{{old('slug',$location->slug)}}"  dir="en" inputclass="dir_en"/>
            </div>

            <div class="row">
                <x-form-select-arr name="parent_id" label="{{__('admin/project.loction')}}" :sendvalue="old('parent_id',$location->parent_id)" :required-span="false" colrow="col-lg-3 " :send-arr="$locationList"/>
                <x-form-select-arr name="projects_type" label="{{__('admin/project.type')}}" :sendvalue="old('projects_type',$location->projects_type)" :required-span="false" colrow="col-lg-3 " :send-arr="$ProjectsTypeArr"/>

                <x-form-input label="Latitude" name="latitude" :requiredSpan="true" colrow="col-lg-3 {{getColDir('en')}}"
                              value="{{old('latitude',$location->latitude)}}"  dir="en" :required-span="false" inputclass="dir_en"/>

                <x-form-input label=" Longitude" name="longitude" :requiredSpan="true" colrow="col-lg-3 {{getColDir('en')}}"
                              value="{{old('longitude',$location->longitude)}}"  dir="en" :required-span="false" inputclass="dir_en"/>

            </div>


            <div class="row">
                @foreach ( config('app.lang_file') as $key=>$lang )
                    <div class="col-lg-6 {{getColDir($key)}}">
                        <x-trans-input
                            label="{{__('admin/def.form_name_'.$key)}} ({{ $key}})"
                            name="{{ $key }}[name]"
                            dir="{{ $key }}"
                            reqname="{{ $key }}.name"
                            value="{{old($key.'.name',$location->translateOrNew($key)->name)}}"
                        />
                    <x-trans-text-area
                                       label="{{ __('admin/form.des_'.$key)}} ({{ ($key) }})"
                                       name="{{ $key }}[des]"
                                       dir="{{ $key }}"
                                       reqname="{{ $key }}.des"
                                       value="{!! old($key.'.des',$location->translateOrNew($key)->des) !!}"
                    />
                    </div>
                @endforeach
            </div>

            <x-meta-tage-filde :body-h1="false" :breadcrumb="false"  :old-data="$location" :placeholder="false" />

            <hr>

            <div class="row">
                <x-form-check-active :row="$location" name="is_active" page-view="{{$pageData['ViewType']}}"/>
                <x-form-check-active :row="$location" name="is_searchable" :defstatus="false" lable="{{ __('admin/project.searchable') }}" page-view="{{$pageData['ViewType']}}"/>

            </div>

            <hr>
            <x-form-upload-file view-type="{{$pageData['ViewType']}}" :row-data="$location"
                                :multiple="false"
                                thisfilterid="{{ \App\Helpers\AdminHelper::arrIsset($modelSettings,'location_filterid',0) }}"
                                emptyphotourl="location.emptyPhoto"  />


            <div class="container-fluid">
                <x-form-submit text="{{$pageData['ViewType']}}" />
            </div>
        </form>

    </x-ui-card>
@endsection


@push('JsCode')


    <script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.config.height = 450;
      //  CKEDITOR.config.contentsCss = "https://realestate.eg/css/bootstrap.min.css";
        CKEDITOR.replace('en[des]');
        CKEDITOR.replace('ar[des]', {
            contentsLangDirection: 'rtl',
        });
    </script>


@endpush



