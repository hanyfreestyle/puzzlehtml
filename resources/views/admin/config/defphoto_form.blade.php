@extends('admin.layouts.app')

@section('content')


    <x-breadcrumb-def :pageData="$pageData"/>

    <x-ui-card title="{{$pageData[$pageData['ViewType'].'PageName']}}">
        <x-mass.confirm-massage />


        <form action="{{route('config.defPhoto.storeUpdate',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
            @csrf

            <x-form-input label="# CatId" name="cat_id" :requiredSpan="true" colrow="col-lg-3"
                          value="{{old('cat_id',$rowData->cat_id)}}" inputclass="dir_en"/>

            <x-form-select-arr  label="{{__('admin.upFilter.form.name')}}" name="filter_id" colrow="col-lg-6"
                                sendvalue="{{old('filter_id',1)}}" :send-arr="$filterTypes"/>



            <div class="form-group">
                <label class="col-md-3 col-form-label">تحديد الصورة</label>
                <div class="col-md-6">
                    <input class="form-control" type="file" name="image" accept="image/*" >
                </div>
                <label class="col-md-3 col-form-label">تحديد الصورة</label>
                <div class="col-md-6">

                     <img src="{{defImagesDir($rowData->photo)}}">
                </div>

            </div>

            <!--
            <input class="form-control" type="file" name="image[]" accept="image/*" multiple >
            -->


            <div class="container-fluid mb-5 mt-2">
                <x-form-submit text="{{$pageData['ViewType']}}" />
            </div>
        </form>

    </x-ui-card>
@endsection
