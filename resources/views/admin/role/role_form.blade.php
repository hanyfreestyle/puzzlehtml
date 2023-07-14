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

        <form  class="mainForm" action="{{route('users.roles.update',intval($role->id))}}" method="post"  enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="view_type" value="{{$pageData['ViewType']}}">
            <div class="col-lg-12">

                <div class="row">
                    <x-form-input label="{{__('admin/config/roles.role_frname')}}" name="name" :requiredSpan="true" colrow="col-lg-4"
                                  value="{{old('name',$role->name)}}" inputclass="dir_en"/>
                </div>

            </div>


            <div class="container-fluid">
                <x-form-submit text="{{$pageData['ViewType']}}" />
            </div>
        </form>
        <hr>
        <h1>Role Permission</h1>
        <div class="row">


            @if($role->permissions)
                @foreach($role->permissions as $role_permission )
                    <form action="{{route('users.roles.permission.remove',[$role->id,$role_permission->id])}}"
                          method="post"  >

                        @csrf
                        @method('DELETE')
                        <button type="submit">{{ $role_permission->name_ar }}</button>

                    </form>

                @endforeach


            @endif

        </div>
        <hr>

        <h1>Role Permission</h1>
        <div class="row">
        @foreach($permissions as $permission)
             @if( !$role->hasPermissionTo($permission) )

                <form action="{{route('users.roles.permission',intval($role->id))}}"
                      method="post"  >

                    @csrf

                    <input type="hidden" name="permission" value="{{$permission->name}}">
                    <button class="btn btn-secondary mr-1 ml-1" type="submit">{{$permission->name_ar}}</button>

                </form>



             @endif

        @endforeach

        </div>



    </x-ui-card>
@endsection


@push('JsCode')

@endpush



