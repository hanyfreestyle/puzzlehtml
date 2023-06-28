@extends('admin.layouts.app')

@section('content')

    @php
        if($pageData['ViewType'] == 'Add'){
            $formRoute = 'Meta.store' ;
        }elseif ($pageData['ViewType'] == 'Edit') {
            $formRoute = 'Meta.update' ;
        }
    @endphp

    <x-breadcrumb-def :pageData="$pageData"/>
    <x-ui-card title="{{$pageData['AddPageName']}}">
        <form action="{{route($formRoute)}}" method="post">
            @csrf
            @if($pageData['ViewType'] == 'Edit')
                <input type="hidden" name="id" value="{{$oldData->id}}">
            @endif
            <x-form-input label="# CatId" name="cat_id" :requiredSpan="true" colrow="col-lg-4"
                          value="{{old('cat_id',$oldData->cat_id)}}" inputclass="dir_en"/>

            <x-meta-tage-filde :body-h1="true" :breadcrumb="true"  :old-data="$oldData" :placeholder="false" />

            <div class="container-fluid">
                <x-form-submit text="{{$pageData['ViewType']}}" />
            </div>
        </form>

    </x-ui-card>
@endsection
