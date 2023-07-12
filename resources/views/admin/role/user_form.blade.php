@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"/>

    <x-ui-card title="{{$pageData[$pageData['ViewType'].'PageName']}}">
        <x-mass.confirm-massage />
        @if(Session::has('mass'))
            <div class="col-lg-12">
                <div class="alert alert-danger alert-dismissible">
                    موجودة
                </div>
            </div>
        @endif
        @if(Session::has('mass2'))
            <div class="col-lg-12">
                <div class="alert alert-success alert-dismissible">
                    تمت الاضافة
                </div>
            </div>
        @endif

        @if(Session::has('mass9'))
            <div class="col-lg-12">
                <div class="alert alert-success alert-dismissible">
                    تم الحذف
                </div>
            </div>
        @endif

        <form  class="mainForm" action="{{route('users.users.update',intval($rowData->id))}}" method="post"  enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="view_type" value="{{$pageData['ViewType']}}">
            <div class="col-lg-12">

                <div class="row">
                    <x-form-input label="{{__('admin/config/roles.role_frname')}}" name="name" :requiredSpan="true" colrow="col-lg-4"
                                  value="{{old('name',$rowData->name)}}" inputclass="dir_en"/>
                </div>

            </div>


            <div class="container-fluid">
                <x-form-submit text="{{$pageData['ViewType']}}" />
            </div>
        </form>
        <hr>




    </x-ui-card>
@endsection


@push('JsCode')

@endpush



