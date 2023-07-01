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
                                    <th>{{__('admin.upFilter.form.name')}}</th>
                                    <th>{{__('admin.upFilter.form.type')}}</th>
                                    <th>{{__('admin.upFilter.form.new_w')}}</th>
                                    <th>{{__('admin.upFilter.form.new_h')}}</th>
                                    <th>WEBP</th>
                                    <th>تدريج رمادى</th>
                                    <th>علامة مائية</th>
                                    <th>اضافة نص</th>
                                    <th></th>
                                    <th></th>

                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $filterTypeArr = config('adminVar.FilterTypeArr');
                                @endphp
                                @foreach($rowData as $row)

                                    <tr>
                                        <td >{{$row->id}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{ $filterTypeArr[$row->type]['name']}}</td>
                                        <td class="text-center">{{$row->new_w}}</td>
                                        <td class="text-center">{{$row->new_h}}</td>
                                        <td class="text-center">{!! printStateIcon($row->convert_state) !!}</td>
                                        <td class="text-center">{!! printStateIcon($row->greyscale) !!}</td>
                                        <td class="text-center">{!! printStateIcon($row->text_state) !!}</td>
                                        <td class="text-center">{!! printStateIcon($row->watermark_state) !!}</td>

                                        <td>
                                            <x-action-button url="{{route('config.upFilter.edit',$row->id)}}" type="edit" :tip="false" />
                                        </td>
                                        <td>
                                            <x-script.sweet-delete-button route-name="config.upFilter.destroy" :row="$row" />
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