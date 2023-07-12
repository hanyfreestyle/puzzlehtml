@extends('admin.layouts.app')

@section('content')
    <x-breadcrumb-def :pageData="$pageData"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12" >
                <x-ui-card title="{{$pageData['ListPageName']}}" addButtonRoute="{!! $pageData['AddPageUrl'] !!}" >
                    <x-mass.confirm-massage />

                    @if(count($rowData)>0)
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{__('admin/def.form_name_ar')}}</th>
                                    <th>{{__('admin/def.form_name_en')}}</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>

                                </tr>
                                </thead>
                                <tbody>

                                @foreach($rowData as $row)

                                    <tr>
                                        <td >{{$row->id}}</td>
                                        <td>{{$row->name}}</td>

                                        <td>{!! AdminHelper::printTableImage($row,'photo') !!} </td>
                                    <!--
                                        <td>{{ //$row->translate('ar')->name}}</td>
                                        <td>{{ //$row->translate('en')->name}}</td>
                                        -->

                                        <td class="text-center">
                                            <x-action-button url="{{route('config.upFilter.edit',$row->id)}}" type="edit" />
                                        </td >

                                        <td class="text-center">
                                            <x-action-button url="#" id="{{route('config.upFilter.destroy',$row->id)}}" type="deleteSweet"  />
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
    <x-sweet-delete-js-no-form />
@endpush
