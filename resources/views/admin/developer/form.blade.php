@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"/>

    <x-ui-card :page-data="$pageData">
        <x-mass.confirm-massage />

        <form  class="mainForm" action="{{route('developer.update',intval($Developer->id))}}" method="post"  enctype="multipart/form-data">
            @csrf
            <div class="row">
                <x-form-input label="Slug" name="slug" :requiredSpan="true" colrow="col-lg-12 {{getColDir('en')}}"
                              value="{{old('slug',$Developer->slug)}}"  dir="en" inputclass="dir_en"/>
            </div>

            <div class="row">
                @foreach ( config('app.lang_file') as $key=>$lang )
                    <div class="col-lg-6 {{getColDir($key)}}">
                        <x-trans-input
                            label="{{__('admin/def.form_name_'.$key)}} ({{ $key}})"
                            name="{{ $key }}[name]"
                            dir="{{ $key }}"
                            reqname="{{ $key }}.name"
                            value="{{old($key.'.name',$Developer->translateOrNew($key)->name)}}"
                        />
                        <x-trans-text-area
                            label="{{ __('admin/form.des_'.$key)}} ({{ ($key) }})"
                            name="{{ $key }}[des]"
                            dir="{{ $key }}"
                            reqname="{{ $key }}.des"
                            value="{!! old($key.'.des',$Developer->translateOrNew($key)->des) !!}"
                        />

                    </div>
                @endforeach
            </div>

            <x-meta-tage-filde :body-h1="true" :breadcrumb="true"  :old-data="$Developer" :placeholder="false" />

            <hr>

            <div class="row">
                <x-form-check-active :row="$Developer" name="is_active" page-view="{{$pageData['ViewType']}}"/>
            </div>

            <hr>

            <x-form-upload-file view-type="{{$pageData['ViewType']}}" :row-data="$Developer"
                                :multiple="false"
                                thisfilterid="{{ \App\Helpers\AdminHelper::arrIsset($modelSettings,'developer_filterid',0) }}"
                                emptyphotourl="developer.emptyPhoto"  />

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