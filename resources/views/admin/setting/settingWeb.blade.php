@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"/>
    <form action="{{route('admin.webConfigUpdate')}}" method="post">
        @csrf


        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <x-ui-card title="{{__('admin/def.web_setting')}}">




                    </x-ui-card>
                </div>
                <div class="col-lg-12">
                    <x-ui-card title="{{__('admin/def.social_media')}}" :add-form-error="false">
                        <div class="row">

                            <x-form-input label="Facebook" name="facebook" :requiredSpan="true" colrow="col-lg-6"
                                          value="{{old('facebook',$setting->facebook)}}" inputclass="dir_en"/>

                            <x-form-input label="Youtube" name="youtube" :requiredSpan="true" colrow="col-lg-6"
                                          value="{{old('youtube',$setting->youtube)}}" inputclass="dir_en"/>

                            <x-form-input label="Twitter" name="twitter" :requiredSpan="true" colrow="col-lg-6"
                                          value="{{old('twitter',$setting->twitter)}}" inputclass="dir_en"/>

                            <x-form-input label="Instagram" name="instagram" :requiredSpan="true" colrow="col-lg-6"
                                          value="{{old('instagram',$setting->instagram)}}" inputclass="dir_en"/>

                            <x-form-input label="Google Api" name="google_api" :requiredSpan="true" colrow="col-lg-12"
                                          value="{{old('google_api',$setting->google_api)}}" inputclass="dir_en"/>

                        </div>
                    </x-ui-card>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <x-form-submit text="Edit" />
        </div>
    </form>
@endsection
