@extends('admin.layouts.app')

@section('content')


    <x-breadcrumb-def :pageData="$pageData"/>

    <x-mass.confirm-massage/>

    @if($errors->has([]))
        <div class=" col-12">
            <div class="alert alert-danger alert-dismissible">
                {{__('general.alertMass.formHasError')}}
            </div>
        </div>
    @endif

    <form class="mainForm uploadFilterForm" action="{{route('config.upFilter.store',intval($rowData->id))}}" method="post">
        @csrf
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-6">
                    <x-ui-card title="{{__('admin.upFilter.form.main_setting')}}" :add-form-error="false"   >

                        <div class="row">
                            <x-form-on-off label="{{__('admin.upFilter.form.convert_state')}}" name="convert_state" value="{{old('convert_state',$rowData->convert_state)}}" colrow="col-lg-7" />
                            <x-form-input label="{{__('admin.upFilter.form.quality_val')}}" name="quality_val" :horizontal-label="true" :requiredSpan="true" colrow="col-lg-5"
                                          value="{{old('quality_val',$rowData->quality_val)}}" inputclass="dir_en"/>
                        </div>
                        <hr>
                        <div class="row">
                            <x-form-input label="{{__('admin.upFilter.form.name')}}" name="name" :requiredSpan="true"   colrow="col-lg-5"
                                          value="{{old('name',$rowData->name)}}" inputclass="dir_ar"/>

                            <x-form-select-arr  label="{{__('admin.upFilter.form.type')}}" name="type" colrow="col-lg-7"
                                                sendvalue="{{old('type',$rowData->type)}}" :send-arr="config('adminVar.FilterTypeArr')"
                            />

                        </div>
                        <div class="row">
                            <x-form-input label="{{__('admin.upFilter.form.new_w')}}" name="new_w" :requiredSpan="true"   colrow="col-lg-4"
                                          value="{{old('new_w',$rowData->new_w)}}" inputclass="dir_en"/>
                            <x-form-input label="{{__('admin.upFilter.form.new_h')}}" name="new_h" :requiredSpan="true"   colrow="col-lg-4"
                                          value="{{old('new_h',$rowData->new_h)}}" inputclass="dir_en"/>
                            <x-form-input-color name="canvas_back" label="{{__('admin.upFilter.form.canvas_back')}}" value="{{old('canvas_back',$rowData->canvas_back)}}" />
                        </div>


                    </x-ui-card>

                    @if(count($rowDataSize) > 0)
                        <x-ui-card title="{{__('admin.upFilter.form.more_photo')}}" :add-form-error="false">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-wrap">
                                    <thead>
                                    <tr>
                                        <th>{{__('admin.upFilter.form.type')}}</th>
                                        <th>{{__('admin.upFilter.form.new_w')}}</th>
                                        <th>{{__('admin.upFilter.form.new_h')}}</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $filterTypeArr = config('adminVar.FilterTypeArr');
                                    @endphp
                                    @foreach($rowDataSize as $DataSize)
                                        <tr>
                                            <td>{{ $filterTypeArr[$DataSize->type]['name']}}</td>
                                            <td class="text-center">{{$DataSize->new_w}}</td>
                                            <td class="text-center">{{$DataSize->new_h}}</td>
                                            <td>
                                                <x-action-button url="{{route('config.upFilter.size.edit',$DataSize->id)}}" type="edit" :tip="true" />
                                            </td>
                                            <td>
                                                <x-action-button id="{{route('config.upFilter.size.destroy',$DataSize->id)}}" type="deleteSweet" :tip="true" url="#" />
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </x-ui-card>
                    @endif

                    @if(intval($rowData->id)!= '0' and  count($rowDataSize) < 2 )
                        <hr>
                        <x-action-button url="{{route('config.upFilter.size.create',$rowData->id)}}" lable="{{__('admin.upFilter.form.add_new_size')}}" size="m" />
                    @endif

                </div>

                <div class="col-lg-6">
                    <x-ui-card title="{{__('admin.upFilter.form.more_setting')}}" :add-form-error="false"   >
                        <div class="row">
                            <x-form-on-off label="{{__('admin.upFilter.form.greyscale')}}" name="greyscale" value="{{old('greyscale',$rowData->greyscale)}}" />
                        </div>
                        <hr>
                        <div class="row">
                            <x-form-on-off label="{{__('admin.upFilter.form.flip_state')}}" name="flip_state" value="{{old('flip_state',$rowData->flip_state)}}" />
                            <x-form-on-off label="{{__('admin.upFilter.form.flip_v')}}" name="flip_v" value="{{old('flip_v',$rowData->flip_v)}}" />
                        </div>
                        <hr>
                        <div class="row">

                            <x-form-on-off label="{{__('admin.upFilter.form.blur')}}" name="blur" value="{{old('blur',$rowData->blur)}}" />
                            <x-form-input label="{{__('admin.upFilter.form.blur_size')}}" name="blur_size" :horizontal-label="true" :requiredSpan="true" colrow="col-lg-5"
                                          value="{{old('blur_size',$rowData->blur_size)}}" inputclass="dir_en"/>
                        </div>
                        <hr>
                        <div class="row">
                            <x-form-on-off label="{{__('admin.upFilter.form.pixelate')}}" name="pixelate" value="{{old('pixelate',$rowData->pixelate)}}" />
                            <x-form-input label="{{__('admin.upFilter.form.pixelate_size')}}" name="pixelate_size" :horizontal-label="true" :requiredSpan="true" colrow="col-lg-5"
                                          value="{{old('pixelate_size',$rowData->pixelate_size)}}" inputclass="dir_en"/>
                        </div>

                    </x-ui-card>
                    <x-ui-card title="{{__('admin.upFilter.form.watermark_setting')}}" :add-form-error="false"   >

                        <div class="row">
                            <x-form-select-arr  label="{{__('admin.upFilter.form.watermark_state')}}" name="watermark_state" colrow="col-lg-5"
                                                sendvalue="{{old('watermark_state',$rowData->watermark_state)}}" :send-arr="config('adminVar.ActiveState')"/>
                            <x-form-select-arr  label="{{__('admin.upFilter.form.watermark_position')}}" name="watermark_position" colrow="col-lg-7"
                                                sendvalue="{{old('watermark_position',$rowData->watermark_position)}}" :send-arr="config('adminVar.watermarkPositionArr')"
                            />
                        </div>
                        <hr>

                        <div class="row">
                            <x-form-select-arr  label="{{__('admin.upFilter.form.watermark_img')}}" name="watermark_img" colrow="col-lg-12" select-type="file"
                                                sendvalue="{{old('watermark_img',$rowData->watermark_img)}}" :send-arr="config('adminVar.logoFileList')"/>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label class="col-md-12 col-form-label">الصورة المستخدمة </label>
                            <div class="col-md-12">
                                <div class="watermark_imgView">
                                    <?php
                                    $watermark_img =old('watermark_img',$rowData->watermark_img);
                                    if($watermark_img != ''){
                                        $thisViewImage = app('url')->asset($watermark_img);
                                    }else{
                                        $thisViewImage = "";
                                    }
                                    ?>
                                    <img id="imageused" class="" src="{{$thisViewImage}}">
                                </div>
                                <input type="hidden" id="app_path" class="form-control force_ltr" value="{{ app('url')->asset("/")}}">
                            </div>
                        </div>


                    </x-ui-card>
                    <x-ui-card title="{{__('admin.upFilter.form.text_setting')}}" :add-form-error="false"   >
                        <div class="row">
                            <x-form-select-arr  label="{{__('admin.upFilter.form.text_state')}}" name="text_state" colrow="col-lg-5"
                                                sendvalue="{{old('text_state',$rowData->text_state)}}" :send-arr="config('adminVar.ActiveState')"/>

                            <x-form-input label="{{__('admin.upFilter.form.text_print')}}" name="text_print" :requiredSpan="true"   colrow="col-lg-7"
                                          value="{{old('text_print',$rowData->text_print)}}" inputclass="dir_en"/>

                        </div>
                        <hr>
                        <div class="row">
                            <x-form-select-arr  label="{{__('admin.upFilter.form.font_path')}}" name="font_path" colrow="col-lg-6" select-type="file"
                                                sendvalue="{{old('font_path',$rowData->font_path)}}" :send-arr="config('adminVar.fontFileList')"/>
                            <x-form-select-arr  label="{{__('admin.upFilter.form.text_position')}}" name="text_position" colrow="col-lg-6"
                                                sendvalue="{{old('text_position',$rowData->text_position)}}" :send-arr="config('adminVar.textPositionArr')"/>

                        </div>
                        <hr>

                        <div class="row">
                            <x-form-input label="{{__('admin.upFilter.form.font_size')}}" name="font_size" :requiredSpan="true"   colrow="col-lg-4"
                                          value="{{old('font_size',$rowData->font_size)}}" inputclass="dir_en"/>
                            <x-form-input label="{{__('admin.upFilter.form.font_opacity')}}" name="font_opacity" :requiredSpan="true"   colrow="col-lg-4"
                                          value="{{old('font_opacity',$rowData->font_opacity)}}" inputclass="dir_en"/>
                            <x-form-input-color name="font_color" label="{{__('admin.upFilter.form.font_color')}}" value="{{old('font_color',$rowData->font_color)}}" />
                        </div>

                    </x-ui-card>
                </div>

            </div>
        </div>
        <div class="container-fluid">
            <x-form-submit text="{{$pageData['ViewType']}}" />
        </div>
    </form>
    <br>
    <br>


@endsection


@push('JsCode')
    <x-script.sweet-delete-js-code-no-form/>
    <script>
        $(document).ready(function(){
            $("#watermark_img").change(function(){
                var getImagePath = $(this).val();
                var appPath = $("#app_path").val();
                var currentImage = appPath+getImagePath  ;
                $("#imageused").attr("src",currentImage);
            });
        });
    </script>
@endpush
