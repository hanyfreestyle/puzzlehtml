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
                                        <th>{{__('admin/def.form_name_ar')}}</th>
                                        <th>{{__('admin/def.form_name_en')}}</th>

                                        @if($pageData['ViewType'] == 'deleteList')
                                            <th>{{ __('admin/page.del_date') }}</th>
                                            <th></th>
                                            <th></th>
                                        @else
                                            <th>{{__('admin/def.status')}}</th>
                                            <th>{{__('admin/def.photo')}}</th>
                                            @can('category_edit')
                                                <th class="tbutaction TD_120" ></th>
                                            @endcan
                                            @can('category_delete')
                                                <th class="tbutaction TD_120" ></th>
                                            @endcan
                                        @endif

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($Categories as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>{{$row->translate('ar')->name}}</td>
                                            <td>{{$row->translate('en')->name}}</td>

                                            @if($pageData['ViewType'] == 'deleteList')
                                                <td>{{$row->deleted_at}}</td>
                                                <td><x-action-button url="{{route('category.restore',$row->id)}}" type="restor" /></td>
                                                <td><x-action-button url="#" id="{{route('category.force',$row->id)}}" type="deleteSweet"/></td>
                                            @else
                                                <td> <x-ajax-update-status-but :row="$row" role="category_edit" /> </td>
                                                <td>{!! AdminHelper::printTableImage($row,'photo') !!} </td>
                                                @can('category_edit')
                                                    <td><x-action-button url="{{route('category.edit',$row->id)}}" type="edit" :tip="false" /></td>
                                                @endcan
                                                @can('category_delete')
                                                    <td><x-action-button url="#" id="{{route('category.destroy',$row->id)}}" type="deleteSweet"/></td>
                                                @endcan
                                            @endif

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
            @if($Categories instanceof \Illuminate\Pagination\AbstractPaginator)
                {{ $Categories->links() }}
            @endif

        </div>


    </section>
@endsection

@push('JsCode')
    <x-sweet-delete-js-no-form/>
    <x-ajax-update-status-js-code url="{{ route('category.updateStatus') }}"/>
@endpush

