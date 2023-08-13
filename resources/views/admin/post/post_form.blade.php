@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"  />
    @if($pageData['ViewType'] == 'Edit')
        <div class="content mb-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-9">
                        <h1 class="def_h1">{{ $Post->translate('ar')->name ?? '' }}</h1>
                    </div>
                    <div class="col-3 text-left">
                        <x-action-button url="{{route('post.More_Photos',$Post->id)}}" type="morePhoto" :tip="false" bg="dark" />
                    </div>
                </div>
            </div>
        </div>
    @endif

    <x-ui-card :page-data="$pageData"  >
        <x-mass.confirm-massage />

        <form  class="mainForm" action="{{route('post.update',intval($Post->id))}}" method="post"  enctype="multipart/form-data">
            @csrf
            <div class="row">
                <x-form-input label="Slug" name="slug" :requiredSpan="true" colrow="col-lg-12 {{getColDir('en')}}"
                              value="{{old('slug',$Post->slug)}}"  dir="en" inputclass="dir_en"/>
            </div>

            <div class="row">
                <x-form-select-arr name="developer_id" label="{{__('admin/form.developer')}}" :sendvalue="old('developer_id',$Post->developer_id)" :required-span="false" colrow="col-lg-3 " :send-arr="$Developers"/>
                <x-form-select-arr name="category_id" label="{{__('admin/form.category')}}" :sendvalue="old('category_id',$Post->category_id)" :required-span="false" colrow="col-lg-3 " :send-arr="$Categories"/>
                <x-form-select-arr name="location_id" label="{{__('admin/project.loction')}}" :sendvalue="old('location_id',$Post->location_id)" :required-span="false" colrow="col-lg-3 " :send-arr="$Locations"/>
            </div>


            <div class="row">
                @foreach ( config('app.lang_file') as $key=>$lang )
                    <div class="col-lg-6 {{getColDir($key)}}">
                        <x-trans-input
                            label="{{__('admin/form.title_'.$key)}} ({{ $key}})"
                            name="{{ $key }}[name]"
                            dir="{{ $key }}"
                            reqname="{{ $key }}.name"
                            value="{{old($key.'.name',$Post->translateOrNew($key)->name)}}"
                        />
                        <x-trans-text-area
                            label="{{ __('admin/form.content_'.$key)}} ({{ ($key) }})"
                            name="{{ $key }}[des]"
                            dir="{{ $key }}"
                            reqname="{{ $key }}.des"
                            value="{!! old($key.'.des',$Post->translateOrNew($key)->des) !!}"
                        />

                    </div>
                @endforeach
            </div>

            <x-meta-tage-filde :body-h1="false" :breadcrumb="false"  :old-data="$Post" :placeholder="false" />

            <hr>

            <div class="row">
                <x-form-check-active :row="$Post" lable="{{__('admin/form.is_published')}}" name="is_published" page-view="{{$pageData['ViewType']}}"/>
            </div>

            <hr>

            <x-form-upload-file view-type="{{$pageData['ViewType']}}" :row-data="$Post"
                                :multiple="false"
                                thisfilterid="{{ \App\Helpers\AdminHelper::arrIsset($modelSettings,'post_filterid',0) }}"
                                emptyphotourl="post.emptyPhoto"  />

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
