@extends('admin.layouts.app')

@section('content')
    {{ __('admin/menu/') }}
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
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>group</th>
                                    <th>sub_dir</th>
                                    <th>Key</th>
                                    <th>Ar</th>
                                    <th>En</th>

                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rowData as $row)
                                    <tr>
                                        <td>{{$row->id}}</td>
                                        <td>{{$row->group}}</td>
                                        <td>{{$row->sub_dir}}</td>
                                        <td>{{$row->lang_key}}</td>
                                        <td>{{$row->translate('ar')->name}}</td>
                                        <td>{{$row->translate('en')->name}}</td>
                                        <td>
                                            <x-action-button url="{{route('langadmin.edit',$row->id)}}" type="edit" :tip="false" />
                                        </td>
                                        <td>
                                            <x-sweet-delete-button route-name="langadmin.destroy" :row="$row" />
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
    <x-sweet-delete-js/>
@endpush

