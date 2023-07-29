@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"/>
    <x-mass.confirm-massage />

    <div class="content mb-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-9">
                    <h1 class="def_h1">{{ $Unit->translate()->name }}</h1>
                </div>
                <div class="col-3 text-left">
                    <x-action-button  url="{{route('unit.edit', $Unit->id)}}" print-lable="{{__('admin/form.button_back')}}" size="s"  bg="dark" icon="fas fa-hand-point-left"  />
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @if(count($UnitPhotos)>0)
                    <div class="row col-lg-12 hanySort">
                        @foreach($UnitPhotos as $Photo)
                            <div class="col-lg-2 ListThisItam">

                                <p class="PhotoImageCard"><img src=" {{ url("ckfinder/userfiles_old/".$Unit->slider_images_dir."/".pathinfo($Photo, PATHINFO_BASENAME)) }}"></p>

                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="col-lg-12">
                        <x-alert-massage type="nodata" />
                    </div>
                @endif
            </div>
        </div>
    </div>






@endsection


@push('JsCode')

@endpush

