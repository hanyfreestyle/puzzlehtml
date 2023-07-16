@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"/>

    <x-ui-card title="{{$pageData[$pageData['ViewType'].'PageName']}}">
        <x-mass.confirm-massage />



        <form  class="mainForm" action="{{route('users.permissions.update',intval($permission->id))}}" method="post"  enctype="multipart/form-data">
            @csrf
            <div class="col-lg-12">
                @if(config('app.development'))
                    <div class="row">
                        <x-form-input label="{{__('admin/config/roles.permission_frname')}}" name="name" :requiredSpan="true" colrow="col-lg-4"
                                      value="{{old('name',$permission->name)}}" inputclass="dir_en"/>

                        <x-form-select-arr name="cat_id" label="{{__('admin/config/roles.model_name')}}" :sendvalue="old('cat_id',$permission->cat_id)" :send-arr="$modelsNameArr"/>
                    </div>
                @else
                    <input type="hidden" name="name" value="{{$permission->name}}">
                    <input type="hidden" name="cat_id" value="{{$permission->cat_id}}">
                @endif




                <div class="row">
                    <x-form-input label="{{__('admin/def.form_name_ar')}}" name="name_ar" :requiredSpan="true" colrow="col-lg-4"
                                  value="{{old('name_ar',$permission->name_ar)}}" inputclass="dir_ar"/>

                    <x-form-input label="{{__('admin/def.form_name_en')}}" name="name_en" :requiredSpan="true" colrow="col-lg-4"
                                  value="{{old('name_en',$permission->name_en)}}" inputclass="dir_en"/>
                </div>

            </div>
            <div class="container-fluid">
                <x-form-submit text="{{$pageData['ViewType']}}" />
            </div>
        </form>

    </x-ui-card>
@endsection





