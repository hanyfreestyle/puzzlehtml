@extends('admin.layouts.app')
@php
    $viewDataTable = \App\Helpers\AdminHelper::arrIsset($modelSettings,'unit_datatable',0) ;
    if($viewDataTable){
        $tableHeader = ' id="MainDataTable" class="table table-bordered table-hover" ';
    }else{
        $tableHeader = ' class="table table-hover" ';
    }
@endphp

@section('StyleFile')
    @if($viewDataTable)
        <x-data-table-plugins :style="true"/>
    @endif

@endsection

@section('content')
    <x-breadcrumb-def :pageData="$pageData"/>


    <div class="content mb-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-9">
                    <h1 class="def_h1">{{ optional($Project->translate('ar'))->name }}</h1>
                </div>
                <div class="col-3 text-left">

                    @if($pageData['ViewType'] == 'deleteList')
                        <x-action-button url="{{route('project.project_units_index',$Project->id)}}" print-lable="{{__('admin/project.list_units')}}" icon="fas fa-bath" :tip="false" bg="p" />
{{--                        <x-action-button url="{{route('unit.More_Photos',$Unit->id)}}" type="morePhoto" :tip="false" bg="dark" />--}}
                    @endif
                </div>
            </div>
        </div>
    </div>



    <section class="div_data">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <x-ui-card  :page-data="$pageData" >
                        <x-mass.confirm-massage/>

                        @if(count($Units)>0)
                            <div class="card-body table-responsive p-0">
                                <table {!! $tableHeader !!} >
                                    <thead>
                                    <tr>
                                        <th class="TD_20">#</th>
                                        <th class="tc">{{__('admin/def.photo')}}</th>
                                        <th class="TD_350">{{__('admin/def.form_name_ar')}}</th>
                                        <th class="TD_350">{{__('admin/def.form_name_en')}}</th>

                                        @if($pageData['ViewType'] == 'deleteList')
                                            <th>{{ __('admin/page.del_date') }}</th>
                                            <th></th>
                                            <th></th>


                                        @else
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            @can('unit_edit')
                                                <th class="tbutaction"></th>
                                            @endcan
                                            @can('unit_delete')
                                                <th class="tbutaction"></th>
                                            @endcan
                                        @endif

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($Units as $Unit)
                                        <tr>
                                            <td>{{$Unit->id}}</td>
                                            <td class="tc">{!! \App\Helpers\AdminHelper::printTableImage($Unit,'photo') !!} </td>

                                            <td>{{optional($Unit->translate('ar'))->name}}</td>
                                            <td>{{optional($Unit->translate('en'))->name}}</td>


                                            @if($pageData['ViewType'] == 'deleteList')
                                                <td>{{$Unit->deleted_at}}</td>
                                                <td class="tc"><x-action-button url="{{route('project.project_units.restore',$Unit->id)}}" type="restor" /></td>
                                                <td class="tc"><x-action-button url="#" id="{{route('project.project_units.force',$Unit->id)}}" type="deleteSweet"/></td>
                                            @else
                                                <td class="text-center">{!! printStateIcon($Unit->is_published) !!}</td>

                                                <td>
                                                    @if($Unit->slider_active)
                                                        <x-action-button url="{{route('project.project_units.Old_Photos',$Unit->id)}}" icon="far fa-folder-open"  :tip="true" bg="p" />
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(count($Unit->getMorePhoto) == '0')
                                                        <x-action-button url="{{route('project.project_units.More_Photos',$Unit->id)}}" type="morePhoto" :tip="true" bg="dark" />
                                                    @else
                                                        <x-action-button url="{{route('project.project_units.More_Photos',$Unit->id)}}" type="morePhoto" :tip="true" />
                                                    @endif

                                                </td>

                                                @can('unit_edit')
                                                    <td class="tc"><x-action-button url="{{route('project.project_units.edit',$Unit->id)}}" type="edit" :tip="true" /></td>
                                                @endcan
                                                @can('unit_delete')
                                                    <td class="tc"><x-action-button url="#" id="{{route('project.project_units.destroy',$Unit->id)}}" :tip="true" type="deleteSweet"/></td>
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
            @if($Units instanceof \Illuminate\Pagination\AbstractPaginator)
                {{ $Units->links() }}
            @endif
        </div>

    </section>
@endsection

@push('JsCode')
    <x-sweet-delete-js-no-form/>
    @if($viewDataTable)
        <x-data-table-plugins :jscode="true" />
    @endif
@endpush
