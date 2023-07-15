@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"/>

    <x-ui-card :page-data="$pageData">
        <x-mass.confirm-massage />


        <form  class="mainForm" action="{{route('users.roles.update',intval($role->id))}}" method="post"  enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="view_type" value="{{$pageData['ViewType']}}">
            <div class="col-lg-12">

                <div class="row">
                    <x-form-input label="{{__('admin/config/roles.role_frname')}}" name="name" :requiredSpan="true" colrow="col-lg-4"
                                  value="{{old('name',$role->name)}}" inputclass="dir_en"/>

                    <x-form-input label="{{__('admin/def.form_name_ar')}}" name="name_ar" :requiredSpan="true" colrow="col-lg-4"
                                  value="{{old('name_ar',$role->name_ar)}}" inputclass="dir_ar"/>

                    <x-form-input label="{{__('admin/def.form_name_en')}}" name="name_en" :requiredSpan="true" colrow="col-lg-4"
                                  value="{{old('name_en',$role->name_en)}}" inputclass="dir_en"/>
                </div>

            </div>


            <div class="container-fluid">
                <x-form-submit text="{{$pageData['ViewType']}}" />
            </div>
        </form>
    </x-ui-card>
@endsection



