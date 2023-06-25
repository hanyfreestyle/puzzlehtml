@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"/>
    <form action="{{route('admin.webConfigUpdate')}}" method="post">
        @csrf


        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-8">
                    <x-ui-card title="{{__('admin/def.web_setting')}}" :add-form-error="false" >

                        <div class="row">
                            @foreach ( config('app.lang_file') as $key=>$lang )
                                <div class="col-lg-6">

                                    <x-trans-input
                                        label="{{__('admin/def.setting_web_name')}} {{ strtoupper($key) }}"
                                        name="{{ $key }}[name]"
                                        dir="{{ $key }}"
                                        reqname="{{ $key }}.name"
                                        value="{{old($key.'.name', $setting->translate($key)->name)}}"
                                    />

                                    <x-trans-input
                                        label="{{__('admin/def.setting_web_g_titel')}} {{ strtoupper($key) }}"
                                        name="{{ $key }}[g_title]"
                                        dir="{{ $key }}"
                                        reqname="{{ $key }}.g_title"
                                        value="{{old($key.'.g_title', $setting->translate($key)->g_title)}}"
                                    />

                                    <x-trans-text-area
                                        label="{{__('admin/def.setting_web_g_des')}} {{ strtoupper($key) }}"
                                        name="{{ $key }}[g_des]"
                                        dir="{{ $key }}"
                                        reqname="{{ $key }}.g_des"
                                        value="{{old($key.'.g_des', $setting->translate($key)->g_des)}}"
                                    />

                                    <x-trans-text-area
                                        label="{{__('admin/def.setting_closed_mass')}} {{ strtoupper($key) }}"
                                        name="{{ $key }}[closed_mass]"
                                        dir="{{ $key }}"
                                        reqname="{{ $key }}.closed_mass"
                                        value="{{old($key.'.closed_mass', $setting->translate($key)->closed_mass)}}"
                                    />

                                </div>
                            @endforeach
                        </div>

                    </x-ui-card>
                </div>

                <div class="col-lg-4" >
                    <x-ui-card title="{{__('admin/def.web_setting')}}" :add-form-error="false" >





                    </x-ui-card>
                </div>

                <div class="col-lg-6">
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
    <br>
    <br>


@endsection
