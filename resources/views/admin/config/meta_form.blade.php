@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"/>
    <x-ui-card :page-data="$pageData">

        <x-mass.confirm-massage/>

        <form class="mainForm" action="{{route('config.meta.update',intval($oldData->id))}}" method="post">
            @csrf
            <div class="row">
            <x-form-input label="# CatId" name="cat_id" :requiredSpan="true" colrow="col-lg-4"
                          value="{{old('cat_id',$oldData->cat_id)}}" inputclass="dir_en"/>
            </div>

            <x-meta-tage-filde :body-h1="true" :breadcrumb="true"  :old-data="$oldData" :placeholder="false" />

            <div class="container-fluid">
                <x-form-submit text="{{$pageData['ViewType']}}" />
            </div>
        </form>

    </x-ui-card>
@endsection
