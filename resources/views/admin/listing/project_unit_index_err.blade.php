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
    <x-breadcrumb-def :pageData="$pageData" />






    <section class="div_data">
        <div class="container-fluid">
            <div class="row">

                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <x-action-button url="{{ route('project.projectUnit.noPhoto')  }}" print-lable="لا توجد صورة " />
                        <x-action-button url="{{ route('project.projectUnit.noAr')  }}" print-lable="لا يوجد محتوى عربى  " />
                        <x-action-button url="{{ route('project.projectUnit.noEn')  }}" print-lable="لا يوجد محتوى انجليزى  " />
                        <x-action-button url="{{ route('project.projectUnit.unActive')  }}" print-lable="غير فعال  " />
                    </div>
                </div>

                <div class="col-lg-12">



                    <x-ui-card  :page-data="$pageData"    >
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


                                        <th>Project Name</th>

                                        @can('unit_edit')
                                            <th class="tbutaction"></th>
                                        @endcan
                                        @can('unit_delete')
                                            <th class="tbutaction"></th>
                                        @endcan


                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($Units as $Unit)
                                        <tr>
                                            <td>{{$Unit->id}}</td>
                                            <td class="tc">{!! \App\Helpers\AdminHelper::printTableImage($Unit,'photo') !!} </td>

                                            <td>{{optional($Unit->translate('ar'))->name}}</td>
                                            <td>{{optional($Unit->translate('en'))->name}}</td>



                                            <td>
                                                {{ $Unit->projectName->name }}

                                            </td>


                                            @can('unit_edit')
                                                <td class="tc"><x-action-button url="{{route('project.project_units.edit',$Unit->id)}}" type="edit" :tip="true" /></td>
                                            @endcan
                                            @can('unit_delete')
                                                <td class="tc"><x-action-button url="#" id="{{route('project.project_units.destroy',$Unit->id)}}" :tip="true" type="deleteSweet"/></td>
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
