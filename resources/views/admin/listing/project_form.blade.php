@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"  />
    @if($pageData['ViewType'] == 'Edit')
        <div class="content mb-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-9">
                        <h1 class="def_h1">{{ $Project->translate('ar')->name ?? "" }}</h1>
                    </div>
                    <div class="col-3 text-left">
                        @if($Project->slider_active)
                            <x-action-button url="{{route('project.Old_Photos',$Project->id)}}" icon="far fa-folder-open"  :tip="true" bg="p" />
                        @endif
                        <x-action-button url="{{route('project.More_Photos',$Project->id)}}" type="morePhoto" :tip="false" bg="dark" />
                        <x-action-button url="{{route('project.faq_list',$Project->id)}}" print-lable="FAQ" icon="fas fa-question" :tip="false" bg="dark" />
                    </div>
                </div>
            </div>
        </div>
    @endif

    <x-ui-card :page-data="$pageData"  >
        <x-mass.confirm-massage />

        <form  class="mainForm" action="{{route('project.update',intval($Project->id))}}" method="post"  enctype="multipart/form-data">
            @csrf
            <div class="row">
                <x-form-input label="Slug" name="slug" :requiredSpan="true" colrow="col-lg-6 {{getColDir('en')}}"
                              value="{{old('slug',$Project->slug)}}"  dir="en" inputclass="dir_en"/>
                <x-form-select-arr name="developer_id" label="{{__('admin/project.developer')}}" :sendvalue="old('developer_id',$Project->developer_id)" :required-span="true" colrow="col-lg-3 " :send-arr="$Developers"/>
                <x-form-select-arr name="location_id" label="{{__('admin/project.loction')}}" :sendvalue="old('location_id',$Project->location_id)" :required-span="true" colrow="col-lg-3 " :send-arr="$Locations"/>
            </div>


            <div class="row">
                <x-form-select-arr name="status" label="{{__('admin/project.project_status') }}" :sendvalue="old('status',$Project->status)" :required-span="true" colrow="col-lg-3 " :send-arr="$ProjectSatues_Arr"/>
                <x-form-select-arr name="project_type" label="{{__('admin/project.project_type')}}" :sendvalue="old('project_type',$Project->project_type)" :required-span="true" colrow="col-lg-3 " :send-arr="$ProjectType_Arr"/>

                <x-form-input label="{{__('admin/project.delivery_date')}}" name="delivery_date" :requiredSpan="true" colrow="col-lg-3 {{getColDir('en')}}"
                              value="{{old('delivery_date',$Project->delivery_date)}}"  dir="ar" inputclass="dir_en"/>

                <x-form-input label="{{__('admin/project.price')}}" name="price" :requiredSpan="true" colrow="col-lg-3 {{getColDir('en')}}"
                              value="{{old('price',$Project->price)}}"  dir="ar" inputclass="dir_en"/>

            </div>

            <div class="row">
                <x-form-input label="Latitude" name="latitude" :requiredSpan="false" colrow="col-lg-3 {{getColDir('en')}}"
                              value="{{old('latitude',$Project->latitude)}}"  dir="ar" inputclass="dir_en"/>

                <x-form-input label="Longitude" name="longitude" :requiredSpan="false" colrow="col-lg-3 {{getColDir('en')}}"
                              value="{{old('longitude',$Project->longitude)}}"  dir="ar" inputclass="dir_en"/>

                <x-form-input label="{{__('admin/project.youtube')}}" name="youtube_url" :requiredSpan="false" colrow="col-lg-3"
                              value="{{old('youtube_url',$Project->youtube_url )}}"  dir="ar" />

            </div>



            <div class="row">
                @foreach ( config('app.lang_file') as $key=>$lang )
                    <div class="col-lg-6 {{getColDir($key)}}">
                        <x-trans-input

                            label="{{__('admin/def.form_name_'.$key)}} ({{ $key}})"
                            name="{{ $key }}[name]"
                            dir="{{ $key }}"
                            reqname="{{ $key }}.name"
                            value="{{old($key.'.name',$Project->translateOrNew($key)->name)}}"
                        />
                        <x-trans-text-area
                            label="{{ __('admin/form.content_'.$key)}} ({{ ($key) }})"
                            name="{{ $key }}[des]"
                            dir="{{ $key }}"
                            reqname="{{ $key }}.des"
                            value="{!! old($key.'.des',$Project->translateOrNew($key)->des) !!}"
                        />

                    </div>
                @endforeach
            </div>

            <x-meta-tage-filde :body-h1="false" :breadcrumb="false"  :old-data="$Project" :placeholder="false" />

            <x-form-amenities :send-data="$Project->amenity"/>

            <div class="row">
                <x-form-check-active :row="$Project" lable="{{__('admin/form.is_published')}}" name="is_published" page-view="{{$pageData['ViewType']}}"/>
            </div>

            <hr>

            <x-form-upload-file view-type="{{$pageData['ViewType']}}" :row-data="$Project"
                                :multiple="false"
                                thisfilterid="{{ \App\Helpers\AdminHelper::arrIsset($modelSettings,'project_filterid',0) }}"
                                emptyphotourl="project.emptyPhoto"  />

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
