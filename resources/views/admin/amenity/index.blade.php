@extends('admin.layouts.app')

@section('content')
    <x-breadcrumb-def :pageData="$pageData"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12" >
                <x-ui-card title="{{$pageData['ListPageName']}}" addButtonRoute="{!! $pageData['AddPageUrl'] !!}" >

                    @if(Session::has('confirmDelete'))
                        <div class="alert alert-success alert-dismissible">
                            {!! Session::get('confirmDelete') !!}
                        </div>
                    @endif

                    @if(count($rowData)>0)
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{__('general.icon')}}</th>
                                    <th>{{__('general.photo')}}</th>
                                    <th>{{__('general.form.name_ar')}}</th>
                                    <th>{{__('general.form.name_en')}}</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rowData as $row)
                                    <tr>
                                        <td>{{$row->id}}</td>
                                        <td>@if($row->icon)<i class="{{$row->icon}}"></i>@endif</td>
                                        <td>
                                            <img  width="80" src="{{defAdminAssets('img/UploadPhoto_Admin.png')}}">
                                        </td>
                                        <td>{{$row->translate('ar')->name}}</td>
                                        <td>{{$row->translate('en')->name}}</td>
                                        <td></td>
                                        <td>
                                            <x-action-button url="{{route('amenity.edit',$row->id)}}" type="edit" :tip="false" />
                                        </td>
                                        <td>
                                            <x-script.sweet-delete-button route-name="amenity.destroy" :row="$row" />
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <x-alert-massage type="nodata" />
                    @endif
                </x-ui-card>

            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $rowData->links() }}
    </div>
@endsection

@push('JsCode')
    <x-script.sweet-delete-js-code/>
@endpush
