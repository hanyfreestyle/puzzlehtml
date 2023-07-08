@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"/>

    <x-ui-card title="{{$pageData[$pageData['ViewType'].'PageName']}}">

        @if(Session::has($pageData['ViewType'].'.Done'))
            <div class="alert alert-success alert-dismissible">
                {!! Session::get($pageData['ViewType'].'.Done') !!}
            </div>
        @endif

        <form  class="mainForm" action="{{route('langadmin.update',intval($rowData->id))}}" method="post"  enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="view_type" value="{{$pageData['ViewType']}}">
            <div class="col-lg-12">
                <div class="row">
                    @foreach ( config('app.lang_file') as $key=>$lang )
                        <div class="col-lg-6">
                            <x-trans-input
                                label="{{__('general.form.name_'.$key)}} ({{ $key}})"
                                name="{{ $key }}[name]"
                                dir="{{ $key }}"
                                reqname="{{ $key }}.name"
                                value="{{old($key.'.name',$rowData->translateOrNew($key)->name)}}"
                            />
                        </div>
                    @endforeach
                </div>
            </div>


            <div class="container-fluid">
                <x-form-submit text="{{$pageData['ViewType']}}" />
            </div>
        </form>

    </x-ui-card>
@endsection


@push('JsCode')

@endpush



