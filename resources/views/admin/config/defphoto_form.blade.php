@extends('admin.layouts.app')

@section('content')


    <x-breadcrumb-def :pageData="$pageData"/>

    <x-ui-card title="{{$pageData[$pageData['ViewType'].'PageName']}}">
    <x-mass.confirm-massage />


        <form action="{{route('config.defPhoto.storeUpdate',intval($rowData->id))}}" method="post">
            @csrf
            <input  name="photo" value="Def/Diar-Logo.jpg">

            <x-form-input label="# CatId" name="cat_id" :requiredSpan="true" colrow="col-lg-4"
                          value="{{old('cat_id',$rowData->cat_id)}}" inputclass="dir_en"/>



            <div class="container-fluid">
                <x-form-submit text="{{$pageData['ViewType']}}" />
            </div>
        </form>

    </x-ui-card>
@endsection
