@extends('admin.layouts.app')

@section('content')
    <x-breadcrumb-def :pageData="$pageData"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12" >
                <x-ui-card :page-data="$pageData" >
                    <x-mass.confirm-massage />

                    @if(count($rowData)>0)
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{__('admin/config/upFilter.form_name')}}</th>
                                    <th>{{__('admin/config/upFilter.form_type')}}</th>
                                    <th>{{__('admin/config/upFilter.form_new_w')}}</th>
                                    <th>{{__('admin/config/upFilter.form_new_h')}}</th>
                                    <th>WEBP</th>
                                    <th>علامة مائية</th>
                                    <th>اضافة نص</th>

                                    @can('upFilter_edit')
                                        <th></th>
                                    @endcan
                                    @can('upFilter_delete')
                                        <th></th>
                                    @endcan



                                </tr>
                                </thead>
                                <tbody>

                                @foreach($rowData as $row)

                                    <tr>
                                        <td >{{$row->id}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{ $filterTypeArr[$row->type]['name'] }}</td>
                                        <td class="text-center">{{$row->new_w}}</td>
                                        <td class="text-center">{{$row->new_h}}</td>
                                        <td class="text-center">{!! printStateIcon($row->convert_state) !!}</td>
                                        <td class="text-center">{!! printStateIcon($row->text_state) !!}</td>
                                        <td class="text-center">{!! printStateIcon($row->watermark_state) !!}</td>


                                        @can('upFilter_edit')
                                            <td class="text-center"><x-action-button url="{{route('config.upFilter.edit',$row->id)}}" type="edit" :tip="true" /></td>
                                        @endcan
                                        @can('upFilter_delete')
                                            <td class="text-center"><x-action-button url="#" id="{{route('config.upFilter.destroy',$row->id)}}" type="deleteSweet" :tip="true" /></td>
                                        @endcan

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
