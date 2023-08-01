@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"  />


    <div class="content mb-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-9">
{{--                    <h1 class="def_h1">{{ optional($Project->translate('fr'))->name }}</h1>--}}
                    <h1 class="def_h1">{{ $Project->translate('fr')->name ?? '' }}</h1>
                </div>
                <div class="col-3 text-left">
                    <x-action-button url="{{route('project.project_units_index',$Project->id)}}" print-lable="{{__('admin/project.list_units')}}" icon="fas fa-bath" :tip="false" bg="p" />
                    @if($pageData['ViewType'] == 'Edit')
                        <x-action-button url="{{route('project.project_units.More_Photos',$Unit->id)}}" type="morePhoto" :tip="false" bg="dark" />
                    @endif
                </div>
            </div>
        </div>
    </div>








    <x-ui-card :page-data="$pageData"  >
        <x-mass.confirm-massage />


        <form  class="mainForm" action="{{route('project.project_units.update',intval($Unit->id))}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="parent_id" value="{{$Project->id}}">
            <input type="hidden" name="developer_id" value="{{$Project->developer_id}}">
            <input type="hidden" name="location_id" value="{{$Project->location_id}}">

            <div class="row">
                <x-form-input label="Slug" name="slug" :requiredSpan="true" colrow="col-lg-6 {{getColDir('en')}}"
                              value="{{old('slug',$Unit->slug)}}"  dir="en" inputclass="dir_en"/>

                <div class="form-group col-lg-3">
                        <label class="def_form_label col-form-label label_ar font-weight-light border-bottom">{{__('admin/project.developer')}}</label>
                    <p class="mt-2 font-weight-bold">{{ $Project->developerName->name }}</p>
                </div>

                <div class="form-group col-lg-3">
                    <label class="def_form_label col-form-label label_ar font-weight-light border-bottom">{{__('admin/project.loction')}}</label>
                    <p class="mt-2 font-weight-bold">{{ $Project->locationName->name }}</p>
                </div>


            </div>

            <div class="row">
                <x-form-select-arr name="property_type" label="{{__('admin/project.property_type')}}" :sendvalue="old('property_type',$Unit->property_type)" :required-span="true" colrow="col-lg-3 " :send-arr="$Property_TypeArr"/>
                <x-form-select-arr name="view" label="{{__('admin/project.view')}}" :sendvalue="old('view',$Unit->view)" :required-span="true" colrow="col-lg-3 " :send-arr="$ListingView_Arr"/>
                <x-form-select-arr name="unit_status" label="{{ __('admin/project.unit_status') }}" :sendvalue="old('unit_status',$Unit->unit_status)" :required-span="true" colrow="col-lg-3 " :send-arr="$UnitSatues_Arr"/>

                <x-form-input label="{{__('admin/project.delivery_date')}}" name="delivery_date" :requiredSpan="false" colrow="col-lg-3 {{getColDir('en')}}"
                              value="{{old('delivery_date',$Unit->delivery_date)}}"  dir="ar" inputclass="dir_en"/>

            </div>


            <div class="row">
                <x-form-input label="{{__('admin/project.price')}}" name="price" :requiredSpan="true" colrow="col-lg-3 {{getColDir('en')}}"
                              value="{{old('price',$Unit->price)}}"  dir="ar" inputclass="dir_en"/>

                <x-form-input label="{{__('admin/project.area')}}" name="area" :requiredSpan="true" colrow="col-lg-3 {{getColDir('en')}}"
                              value="{{old('area',$Unit->area)}}"  dir="ar" inputclass="dir_en"/>

                <x-form-input label="{{__('admin/project.baths')}}" name="baths" :requiredSpan="true" colrow="col-lg-3 {{getColDir('en')}}"
                              value="{{old('baths',$Unit->baths)}}"  dir="ar" inputclass="dir_en"/>

                <x-form-input label="{{__('admin/project.rooms')}}" name="rooms" :requiredSpan="true" colrow="col-lg-3 {{getColDir('en')}}"
                              value="{{old('rooms',$Unit->rooms)}}"  dir="ar" inputclass="dir_en"/>

            </div>


            <div class="row">
                <x-form-input label="Latitude" name="latitude" :requiredSpan="false" colrow="col-lg-3 {{getColDir('en')}}"
                              value="{{old('latitude',$Unit->latitude)}}"  dir="ar" inputclass="dir_en"/>

                <x-form-input label="Longitude" name="longitude" :requiredSpan="false" colrow="col-lg-3 {{getColDir('en')}}"
                              value="{{old('longitude',$Unit->longitude)}}"  dir="ar" inputclass="dir_en"/>

                <x-form-input label="{{__('admin/project.youtube')}}" name="youtube_url" :requiredSpan="false" colrow="col-lg-3"
                              value="{{old('youtube_url',$Unit->youtube_url )}}"  dir="ar" />

                <x-form-input label="{{__('admin/project.contact_number')}}" name="contact_number" :requiredSpan="false" colrow="col-lg-3"
                              value="{{old('contact_number',$Unit->contact_number )}}"  dir="ar" />

            </div>


            <div class="row">
                @foreach ( config('app.lang_file') as $key=>$lang )
                    <div class="col-lg-6 {{getColDir($key)}}">
                        <x-trans-input

                            label="{{__('admin/def.form_name_'.$key)}} ({{ $key}})"
                            name="{{ $key }}[name]"
                            dir="{{ $key }}"
                            reqname="{{ $key }}.name"
                            value="{{old($key.'.name',$Unit->translateOrNew($key)->name)}}"
                        />
                        <x-trans-text-area
                            label="{{ __('admin/form.content_'.$key)}} ({{ ($key) }})"
                            name="{{ $key }}[des]"
                            dir="{{ $key }}"
                            reqname="{{ $key }}.des"
                            value="{!! old($key.'.des',$Unit->translateOrNew($key)->des) !!}"
                        />

                    </div>
                @endforeach
            </div>

            <x-meta-tage-filde :body-h1="false" :breadcrumb="false"  :old-data="$Unit" :placeholder="false" />

            <x-form-amenities :send-data="$Unit->amenity"/>


            <div class="row">
                <x-form-check-active :row="$Unit" lable="{{__('admin/form.is_published')}}" name="is_published" page-view="{{$pageData['ViewType']}}"/>
            </div>

            <hr>

            <x-form-upload-file view-type="{{$pageData['ViewType']}}" :row-data="$Unit"
                                :multiple="false"
                                thisfilterid="{{ \App\Helpers\AdminHelper::arrIsset($modelSettings,'unit_filterid',0) }}"
                                emptyphotourl="project.project_units.emptyPhoto"  />

            <div class="container-fluid">
                <x-form-submit text="{{$pageData['ViewType']}}" />
            </div>
        </form>

    </x-ui-card>
@endsection


@push('JsCode')
        <script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.config.height = 450;
            //  CKEDITOR.config.contentsCss = "https://realestate.eg/css/bootstrap.min.css";
            CKEDITOR.replace('en[des]');
            CKEDITOR.replace('ar[des]', {
                contentsLangDirection: 'rtl',
            });
        </script>

@endpush
