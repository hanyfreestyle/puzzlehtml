@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"  />
    @if($pageData['ViewType'] == 'Edit')
        <div class="content mb-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-9">
                        <h1 class="def_h1">{{ $Project->translate('ar')->name }}</h1>
                    </div>
                    <div class="col-3 text-left">
                        <x-action-button url="{{route('project.More_Photos',$Project->id)}}" type="morePhoto" :tip="false" bg="dark" />
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
                <x-form-input label="Slug" name="slug" :requiredSpan="true" colrow="col-lg-12 {{getColDir('en')}}"
                              value="{{old('slug',$Project->slug)}}"  dir="en" inputclass="dir_en"/>
            </div>

{{--            <div class="row">--}}
{{--                <x-form-select-arr name="developer_id" label="{{__('admin/form.developer')}}" :sendvalue="old('developer_id',$Project->developer_id)" :required-span="false" colrow="col-lg-3 " :send-arr="$Developers"/>--}}
{{--                <x-form-select-arr name="category_id" label="{{__('admin/form.category')}}" :sendvalue="old('category_id',$Project->category_id)" :required-span="false" colrow="col-lg-3 " :send-arr="$Categories"/>--}}
{{--            </div>--}}


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

            <hr>

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
