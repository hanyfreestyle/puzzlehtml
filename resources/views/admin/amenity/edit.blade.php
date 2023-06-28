@extends('admin.layouts.app')
@section('JsCode')
    <script src="{{defAdminAssets('plugins/bootstrap-iconpicker/js/bootstrap-iconpicker.bundle.min.js')}}"></script>
<script>
    $('#Hanytarget').on('change', function(e) {
        ///console.log(e.icon);
        //alert('kkkkkkk')

        $("#HanyDarwish").val(e.icon);
        $(".first").addClass(e.icon);
    });
</script>
@endsection
@section('content')
    <x-breadcrumb-def :pageData="$pageData"/>
    <x-ui-card title="{{$pageData['AddPageName']}}">
        <form action="{{route('amenity.update',$oldData->id)}}" method="post">
            @csrf
            @method('PUT')




<input type="text" name="id" value="{{$oldData->id}}">
            <div class="col-lg-12">
                <div class="row">
                    @foreach ( config('app.lang_file') as $key=>$lang )
                        <div class="col-lg-6">
                            <x-trans-input
                                label="{{__('general.form.name_'.$key)}} ({{ $key}})"
                                name="{{ $key }}[name]"
                                dir="{{ $key }}"
                                reqname="{{ $key }}.name"
                                value="{{old($key.'.name',$oldData->translate($key)->name)}}"
                            />
                        </div>
                    @endforeach
                </div>
            </div>
<!--
            <x-form-input label="Icon" name="icon" :requiredSpan="false" colrow="col-lg-4"
                          value="{{old('icon',$oldData->icon)}}" inputclass="dir_en"/>
-->





            <div class="form-group col-lg-4"style="direction: ltr!important;">
                <div class="">
                    <label class="col-form-label font-weight-light " for="">Icon
                    </label>
                </div>

                <div class="" style="direction: ltr!important;">
                 <input type="hidden" name="icon" id="HanyDarwish" value="{{old('icon',$oldData->icon)}}"  >
                 <button class="btn btn-primary"
                         data-align="center"
                         data-icon="{{old('icon',$oldData->icon)}}" id="Hanytarget" role="iconpicker"></button>
                </div>

            </div>



            <div class="container-fluid">
                <x-form-submit text="{{$pageData['ViewType']}}" />
            </div>
        </form>

    </x-ui-card>
@endsection
