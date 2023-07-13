@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"/>

    <x-ui-card title="{{$pageData[$pageData['ViewType'].'PageName']}}">
        <x-mass.confirm-massage />
        <form  autocomplete="off" class="mainForm pb-0" action="{{route('users.users.update',intval($rowData->id))}}" method="post"  enctype="multipart/form-data">
            @csrf
            <div class="col-lg-12">

                <div class="row">
                    <x-form-input label="{{__('admin/config/roles.users_fr_name')}}" name="name" :requiredSpan="true" colrow="col-lg-4"
                                  value="{{old('name',$rowData->name)}}" inputclass="dir_en"/>

                    <x-form-input label="{{__('admin/config/roles.users_fr_email')}}" name="email" :requiredSpan="true" colrow="col-lg-4"
                                  value="{{old('email',$rowData->email)}}" inputclass="dir_en"/>

                    <x-form-input label="{{__('admin/config/roles.users_fr_phone')}}" name="phone" :requiredSpan="true" colrow="col-lg-4"
                                  value="{{old('phone',$rowData->phone)}}" inputclass="dir_en"/>

                    @php
                        if($pageData['ViewType'] == 'Add'){
                              $passReq = true;
                        }else{
                              $passReq = false;
                        }
                    @endphp




                        <x-form-input label="{{__('admin/form.password')}}" name="user_password" :requiredSpan="$passReq" colrow="col-lg-4"
                                      value="{{ old('user_password','') }}" type="password" inputclass="dir_en"/>

                        <x-form-input label="{{__('admin/form.password_confirm')}}" name="user_password_confirmation" :requiredSpan="$passReq" colrow="col-lg-4"
                                      value="{{old('user_password_confirmation')}}" type="password" inputclass="dir_en"/>
                </div>
                <hr>
                    <x-form-upload-file view-type="{{$pageData['ViewType']}}" :row-data="$rowData" :multiple="false"/>
            </div>


            <div class="container-fluid">
                <x-form-submit text="{{$pageData['ViewType']}}" />
            </div>
        </form>

    </x-ui-card>
@endsection


@push('JsCode')
    <script type="text/javascript">


        $(window).load(function() {
            $("input[type=password]").val('');
        });
    </script>
@endpush



