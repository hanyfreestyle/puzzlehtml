@extends('admin.layouts.app')

@section('content')
    <x-breadcrumb-def :pageData="$pageData"/>
    <x-mass.confirm-massage />

    <form class="mainForm" action="{{route('admin.webConfigUpdate')}}" method="post">
        @csrf
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-4" >
                    <x-ui-card title="" :add-form-error="false" >
                        <div class="form-group">
                            <label for="inputEmail3" class="col-lg-4 col-form-label">{{ __('admin/config/admin.config_web_status') }}</label>
                            <div class="col-lg-8">
                                <input type="checkbox" name="web_status" @if($setting->web_status == '1') checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">
                            </div>
                        </div>


                        <x-form-input label="{{ __('admin/config/admin.config_phone') }}" name="phone_num" :requiredSpan="true" colrow="col-lg-12"
                                      value="{{old('phone_num',$setting->phone_num)}}" inputclass="dir_en"/>

                        <x-form-input label="{{ __('admin/config/admin.config_whatsapp') }}" name="whatsapp_num" :requiredSpan="true" colrow="col-lg-12"
                                      value="{{old('whatsapp_num',$setting->whatsapp_num)}}" inputclass="dir_en"/>

                    </x-ui-card>
                </div>

                <div class="col-lg-8">
                    <x-ui-card title="" :add-form-error="false"  >

                        <div class="row">
                            @foreach ( config('app.lang_file') as $key=>$lang )
                                <div class="col-lg-6 {{getColDir($key)}}">

                                    <x-trans-input
                                        label="{{__('admin/config/admin.config_website_name_'.$key)}} ({{ $key}})"
                                        name="{{ $key }}[name]"
                                        dir="{{ $key }}"
                                        reqname="{{ $key }}.name"
                                        value="{{old($key.'.name', $setting->translate($key)->name)}}"
                                    />

                                    <x-trans-input
                                        label="{{__('admin/form.meta_g_title_'.$key)}} ({{ $key}})"
                                        name="{{ $key }}[g_title]"
                                        dir="{{ $key }}"
                                        reqname="{{ $key }}.g_title"
                                        value="{{old($key.'.g_title', $setting->translate($key)->g_title)}}"
                                    />

                                    <x-trans-text-area
                                        label="{{__('admin/form.meta_g_des_'.$key)}} ({{ $key}})"
                                        name="{{ $key }}[g_des]"
                                        dir="{{ $key }}"
                                        reqname="{{ $key }}.g_des"
                                        value="{{old($key.'.g_des', $setting->translate($key)->g_des)}}"
                                    />

                                    <x-trans-text-area
                                        label="{{__('admin/config/admin.config_closed_mass_'.$key)}} ({{ $key}})"
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



                <div class="col-lg-12">
                    <x-ui-card title="{{ __('admin/config/admin.config_social_media')}}" :add-form-error="false">
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
