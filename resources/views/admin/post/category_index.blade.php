@extends('admin.layouts.app')

@section('content')
    <x-breadcrumb-def :pageData="$pageData"/>
    <section class="div_data">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <x-ui-card  :page-data="$pageData" >
                        <x-mass.confirm-massage/>

                        @if(count($Categories)>0)
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>

                                        <th>{{__('admin/def.photo')}}</th>
                                        <th>{{__('admin/def.form_name_ar')}}</th>
                                        <th>{{__('admin/def.form_name_en')}}</th>
                                        @can('category_edit')
                                            <th class="tbutaction TD_120" ></th>
                                        @endcan
                                        @can('category_delete')
                                            <th class="tbutaction TD_120" ></th>
                                        @endcan
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($Categories as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>

                                            <td>{!! AdminHelper::printTableImage($row,'photo') !!} </td>
                                            <td>{{$row->translate('ar')->name}}</td>
                                            <td>{{$row->translate('en')->name}}</td>
                                            @can('category_edit')
                                                <td><x-action-button url="{{route('category.edit',$row->id)}}" type="edit" :tip="false" /></td>
                                            @endcan
                                            @can('category_delete')
                                                <td ><x-sweet-delete-button route-name="category.destroy" :row="$row" /></td>
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
            {{ $Categories->links() }}
        </div>
    </section>
@endsection

@push('JsCode')
    <x-sweet-delete-js/>
@endpush

