@extends('admin.layouts.app')
@php
    $viewDataTable = \App\Helpers\AdminHelper::arrIsset($modelSettings,'project_datatable',0) ;
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
    <section class="div_data">
        <div class="container-fluid">
            <div class="row">

                <div class="row"><div class="col-lg-12 mb-2">
                        <x-action-button url="{{ route('project.noPhoto')  }}" print-lable="لا توجد صورة " />
                        <x-action-button url="{{ route('project.noAr')  }}" print-lable="لا يوجد محتوى عربى  " />
                        <x-action-button url="{{ route('project.noEn')  }}" print-lable="لا يوجد محتوى انجليزى  " />
                        <x-action-button url="{{ route('project.unActive')  }}" print-lable="غير فعال  " />
                    </div></div>

                <div class="col-lg-12">
                    <x-ui-card  :page-data="$pageData" >
                        <x-mass.confirm-massage/>
                        @if(count($Projects)>0)
                            <div class="card-body table-responsive p-0">
                                <table {!! $tableHeader !!} >
                                    <thead>
                                    <tr>
                                        <th class="TD_20">#</th>
                                        <th class="tc">{{__('admin/def.photo')}}</th>
                                        <th class="TD_350">{{__('admin/def.form_name_ar')}}</th>
                                        <th class="TD_350">{{__('admin/def.form_name_en')}}</th>
                                        @can('project_edit')
                                            <th class="tbutaction"></th>
                                        @endcan
                                        @can('project_delete')
                                            <th class="tbutaction"></th>
                                        @endcan
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($Projects as $Project)
                                        <tr>
                                            <td>{{$Project->id}}</td>
                                            <td class="tc">{!! \App\Helpers\AdminHelper::printTableImage($Project,'photo') !!} </td>

                                            <td>{{optional($Project->translate('ar'))->name}}</td>
                                            <td>{{optional($Project->translate('en'))->name}}</td>
                                            @can('project_edit')
                                                <td class="tc"><x-action-button url="{{route('project.edit',$Project->id)}}" type="edit" :tip="true" /></td>
                                            @endcan
                                            @can('project_delete')
                                                <td class="tc"><x-action-button url="#" id="{{route('project.destroy',$Project->id)}}" :tip="true" type="deleteSweet"/></td>
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
            @if($Projects instanceof \Illuminate\Pagination\AbstractPaginator)
                {{ $Projects->links() }}
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


