@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"/>

    <x-ui-card title="{{$pageData[$pageData['ViewType'].'PageName']}}" can="hhhhh" >
        <x-mass.confirm-massage />
        <form  data-parsley-validate class="mainForm pb-0" action="{{route('users.users.update',intval($users->id))}}" method="post"  enctype="multipart/form-data">
            @csrf
            <div class="col-lg-12">

                <div class="row">
                    <x-form-input label="{{__('admin/config/roles.users_fr_name')}}" name="name" :requiredSpan="true" colrow="col-lg-4"
                                  value="{{old('name',$users->name)}}" inputclass="dir_en"/>

                    <x-form-input label="{{__('admin/config/roles.users_fr_email')}}" name="email" :requiredSpan="true" colrow="col-lg-4"
                                  value="{{old('email',$users->email)}}" inputclass="dir_en"/>

                    <x-form-input label="{{__('admin/config/roles.users_fr_phone')}}" name="phone" :requiredSpan="true" colrow="col-lg-4"
                                  value="{{old('phone',$users->phone)}}" inputclass="dir_en"/>

                    @php
                        if($pageData['ViewType'] == 'Add'){
                              $passReq = true;
                        }else{
                              $passReq = false;
                        }
                    @endphp




                    <x-form-input label="{{__('admin/form.password')}}" name="user_password" :requiredSpan="$passReq" colrow="col-lg-4"
                                  value="{{ old('user_password') }}" type="password" inputclass="dir_en"/>

                    <x-form-input label="{{__('admin/form.password_confirm')}}" name="user_password_confirmation" :requiredSpan="$passReq" colrow="col-lg-4"
                                  value="{{old('user_password_confirmation')}}" type="password" inputclass="dir_en"/>
                </div>
                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{__('admin/config/roles.users_fr_role')}}</label>
                            @php
                                $printName = getRoleName();
                            @endphp
                            <select class="select2  @error('roles') is-invalid @enderror" name="roles[]" multiple="multiple" data-placeholder="{{__('admin/config/roles.users_fr_role_selone')}}" style="width: 100%;"  data-parsley-required="true" >
                                @foreach($roles as $role)
                                    <option value="{{$role->name}}" @if(isset($userRole[$role->id])) selected @endif >{{ $role->$printName }}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ \App\Helpers\AdminHelper::error($errors->first('roles'),'roles',"hany") }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <hr>
                <x-form-upload-file  view-type="{{$pageData['ViewType']}}" :row-data="$users" thisfilterid="1" emptyphotourl="users.users.emptyPhoto" :multiple="false"/>
            </div>


            <div class="container-fluid">
                <x-form-submit text="{{$pageData['ViewType']}}" />
            </div>
        </form>

    </x-ui-card>
@endsection

