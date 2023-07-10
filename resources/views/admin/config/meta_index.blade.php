@extends('admin.layouts.app')

@section('content')
    <x-breadcrumb-def :pageData="$pageData"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12" >
                <x-ui-card title="{{$pageData['ListPageName']}}" addButtonRoute="{!! $pageData['AddPageUrl'] !!}" >

                    <x-mass.confirm-massage/>

                    @if(count($rowData)>0)
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>CatId</th>
                                    <th>{{__('admin/form.meta_g_title_'.thisCurrentLocale())}}</th>
                                    <th>{{__('admin/form.meta_g_des_'.thisCurrentLocale())}}</th>
                                    <th>{{__('admin/form.meta_bodyH1_'.thisCurrentLocale())}}</th>
                                    <th>{{__('admin/form.meta_breadcrumb_'.thisCurrentLocale())}}</th>
                                    <th></th>
                                    <th></th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rowData as $row)
                                    <tr>
                                        <td>{{$row->id}}</td>
                                        <td>{{$row->cat_id}}</td>
                                        <td>{{$row->translate(thisCurrentLocale())->g_title}}</td>
                                        <td>{{$row->translate(thisCurrentLocale())->g_des}}</td>
                                        <td>{{$row->translate(thisCurrentLocale())->body_h1}}</td>
                                        <td>{{$row->translate(thisCurrentLocale())->breadcrumb}}</td>
                                        <td>
                                            <x-action-button url="{{route('config.meta.edit',$row->id)}}" type="edit" :tip="false" />
                                        </td>
                                        <td>
                                            <x-sweet-delete-button route-name="config.meta.destroy" :row="$row" />
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
