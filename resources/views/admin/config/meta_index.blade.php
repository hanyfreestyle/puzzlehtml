@extends('admin.layouts.app')

@section('content')
    <x-breadcrumb-def :pageData="$pageData"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12" >
                <x-ui-card :page-data="$pageData" >

                    <x-mass.confirm-massage/>

                    @if(count($rowData)>0)
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>CatId</th>
                                    <th>{{__('admin/form.meta_g_title_'.thisCurrentLocale())}}</th>
                                    <th>{{__('admin/form.meta_g_des_'.thisCurrentLocale())}}</th>
                                    <th>{{__('admin/form.meta_bodyH1_'.thisCurrentLocale())}}</th>
                                    <th>{{__('admin/form.meta_breadcrumb_'.thisCurrentLocale())}}</th>
                                    @can('meta_edit')
                                        <th class="text-center"></th>
                                    @endcan
                                    @can('meta_delete')
                                        <th class="text-center"></th>
                                    @endcan

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rowData as $row)
                                    <tr>
                                        <td>{{$row->id}}</td>
                                        <td>{{$row->cat_id}}</td>
                                        <td>{{$row->translate(thisCurrentLocale())->g_title}}</td>
                                        <td>{{ Str::limit($row->translate(thisCurrentLocale())->g_des,200) }}</td>
                                        <td>{{$row->translate(thisCurrentLocale())->body_h1}}</td>
                                        <td>{{$row->translate(thisCurrentLocale())->breadcrumb}}</td>

                                        @can('meta_edit')
                                            <td class="text-center"><x-action-button url="{{route('config.meta.edit',$row->id)}}" type="edit" :tip="false" /></td>
                                        @endcan
                                        @can('meta_delete')
                                            <td class="text-center" ><x-sweet-delete-button route-name="config.meta.destroy" :row="$row" /></td>
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
    <x-sweet-delete-js/>
@endpush
