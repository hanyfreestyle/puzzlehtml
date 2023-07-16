@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"/>

    <x-ui-card :page-data="$pageData">
        <x-mass.confirm-massage />



        <form  class="mainForm" action="{{route('category.update',intval($Category->id))}}" method="post"  enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="view_type" value="{{$pageData['ViewType']}}">
            <div class="col-lg-12">
                <div class="row">
                <x-form-input label="Slug" name="slug" :requiredSpan="true" colrow="col-lg-12"
                              value="{{old('slug',$Category->slug)}}" inputclass="dir_en"/>

                </div>

                <div class="row">
                    @foreach ( config('app.lang_file') as $key=>$lang )
                        <div class="col-lg-6 {{getColDir($key)}}">
                            <x-trans-input

                                label="{{__('admin/def.form_name_'.$key)}} ({{ $key}})"
                                name="{{ $key }}[name]"
                                dir="{{ $key }}"
                                reqname="{{ $key }}.name"
                                value="{{old($key.'.name',$Category->translateOrNew($key)->name)}}"
                            />
                        </div>
                    @endforeach
                </div>
            </div>

            <x-meta-tage-filde :body-h1="true" :breadcrumb="true"  :old-data="$Category" :placeholder="false" />

            <hr>
            <x-form-select-arr  label="{{__('admin/def.form_selectFilterLable')}}" name="filter_id" colrow="col-lg-6"
                                sendvalue="{{old('filter_id')}}" :send-arr="$filterTypes"/>

            <x-form-upload-file view-type="{{$pageData['ViewType']}}" :row-data="$Category" :multiple="false"/>

            <div class="container-fluid">
                <x-form-submit text="{{$pageData['ViewType']}}" />
            </div>
        </form>

    </x-ui-card>
@endsection


@push('JsCode')

@endpush



