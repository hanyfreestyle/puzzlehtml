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
                                        <th></th>
                                        <th></th>

                                        @if($pageData['ViewType'] == 'deleteList')
                                            <th>{{ __('admin/page.del_date') }}</th>
                                            <th></th>
                                            <th></th>

                                        @else
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            @can('project_edit')
                                                <th class="tbutaction"></th>
                                            @endcan
                                            @can('project_delete')
                                                <th class="tbutaction"></th>
                                            @endcan
                                        @endif

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($Projects as $Project)
                                        <tr>
                                            <td>{{$Project->id}}</td>
                                            <td class="tc">{!! \App\Helpers\AdminHelper::printTableImage($Project,'photo') !!} </td>

                                            <td>{{optional($Project->translate('ar'))->name}}</td>
                                            <td>{{optional($Project->translate('en'))->name}}</td>
                                            <td class="text-center">{!! printStateIcon($Project->is_published) !!}</td>
                                            <td>
                                                @if($Project->slider_active == 1)
                                                    <x-action-button url="{{route('project.Old_Photos',$Project->id)}}" icon="far fa-folder-open"  :tip="true" bg="p" />
                                                @endif
                                            </td>

                                            @if($pageData['ViewType'] == 'deleteList')
                                                <td>{{$Project->deleted_at}}</td>
                                                <td class="tc"><x-action-button url="{{route('project.restore',$Project->id)}}" type="restor" /></td>
                                                <td class="tc"><x-action-button url="#" id="{{route('project.force',$Project->id)}}" type="deleteSweet"/></td>
                                            @else
                                                <td>
                                                    <x-project-table-icon name="Units" icon="fas fa-bath"
                                                                          :count="$Project->get_units_to_project_count"
                                                                          url="{{route('project.project_units_index',$Project->id)}}" />
                                                </td>

                                                <td>
                                                    <x-project-table-icon name="Photo" icon="fas fa-images"
                                                                          :count="$Project->get_more_photo_count"
                                                                          url="{{route('project.More_Photos',$Project->id)}}" />
                                                </td>

                                                <td>
                                                    <x-project-table-icon name="FAQ" icon="fas fa-question"
                                                                          :count="$Project->faq_to_project_count"
                                                                          url="{{route('project.faq_list',$Project->id)}}" />
                                                </td>

                                                @can('project_edit')
                                                    <td class="tc"><x-action-button url="{{route('project.edit',$Project->id)}}" type="edit" :tip="true" /></td>
                                                @endcan
                                                @can('project_delete')
                                                    <td class="tc"><x-action-button url="#" id="{{route('project.destroy',$Project->id)}}" :tip="true" type="deleteSweet"/></td>
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


