@extends('admin.layouts.app')

@section('content')

    @php
        if($pageData['ViewType'] == 'Add'){
            $formRoute = 'config.meta.store' ;
        }elseif ($pageData['ViewType'] == 'Edit') {
            $formRoute = 'config.meta.update' ;
        }
    @endphp

    <x-breadcrumb-def :pageData="$pageData"/>
    <x-ui-card title="{{$pageData['AddPageName']}}">

        <x-mass.confirm-massage/>

        <form class="mainForm" action="{{route($formRoute,intval($oldData->id))}}" method="post">
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
