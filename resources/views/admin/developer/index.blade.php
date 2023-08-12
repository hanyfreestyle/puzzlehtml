@extends('admin.layouts.app')
@php
    $viewDataTable = \App\Helpers\AdminHelper::arrIsset($modelSettings,'developer_datatable',0) ;
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

            <div class="row"><div class="col-lg-12 mb-2">
                <x-action-button url="{{ route('developer.noPhoto')  }}" print-lable="لا توجد صورة " />
                <x-action-button url="{{ route('developer.slugErr')  }}" print-lable="رابط متكرر " />
                <x-action-button url="{{ route('developer.noAr')  }}" print-lable="لا يوجد محتوى عربى  " />
                <x-action-button url="{{ route('developer.noEn')  }}" print-lable="لا يوجد محتوى انجليزى  " />
                <x-action-button url="{{ route('developer.unActive')  }}" print-lable="غير فعال  " />
            </div> </div>


            <div class="row">
                <div class="col-lg-12">

                    <x-ui-card  :page-data="$pageData" title="" >
                        <x-mass.confirm-massage/>

                        @if(count($Developers)>0)
                            <div class="card-body table-responsive p-0">
                                <table {!! $tableHeader !!} >
                                    <thead>
                                    <tr>
                                        <th class="TD_20">#</th>
                                        <th>{{__('admin/def.form_name_ar')}}</th>
                                        <th>{{__('admin/def.form_name_en')}}</th>

                                        @if($pageData['ViewType'] == 'deleteList')
                                            <th>{{ __('admin/page.del_date') }}</th>
                                            <th></th>
                                            <th></th>
                                        @else

                                            <th></th>
                                            <th class="tc">{{__('admin/def.photo')}}</th>
                                            @can('developer_edit')
                                                <th class="tbutaction"></th>
                                            @endcan
                                            @can('developer_delete')
                                                <th class="tbutaction"></th>
                                            @endcan
                                        @endif

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($Developers as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>

                                            <td>{{optional($row->translate('ar'))->name }}</td>
                                            <td>{{optional($row->translate('en'))->name}}</td>


                                            @if($pageData['ViewType'] == 'deleteList')
                                                <td>{{$row->deleted_at}}</td>
                                                <td class="tc"><x-action-button url="{{route('developer.restore',$row->id)}}" type="restor" /></td>
                                                <td class="tc"><x-action-button url="#" id="{{route('developer.force',$row->id)}}" type="deleteSweet"/></td>
                                            @else
                                                <td>
                                                    @if($row->getMorePhoto_count== '0')
                                                        <x-action-button url="{{route('developer.More_Photos',$row->id)}}" type="morePhoto" :tip="true" bg="dark" />
                                                    @else
                                                        <x-action-button url="{{route('developer.More_Photos',$row->id)}}" type="morePhoto" :tip="true" />
                                                    @endif

                                                </td>
                                                {{--<td class="tc"> <x-ajax-update-status-but :row="$row" role="developer_edit" /> </td>--}}
                                                <td class="tc">{!! \App\Helpers\AdminHelper::printTableImage($row,'photo') !!} </td>
                                                @can('developer_edit')
                                                    <td class="tc"><x-action-button url="{{route('developer.edit',$row->id)}}" type="edit" :tip="false" /></td>
                                                @endcan
                                                @can('developer_delete')
                                                    <td class="tc"><x-action-button url="#" id="{{route('developer.destroy',$row->id)}}" type="deleteSweet"/></td>
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
            @if($Developers instanceof \Illuminate\Pagination\AbstractPaginator)
                {{ $Developers->links() }}
            @endif

        </div>


    </section>
@endsection

@push('JsCode')
    <x-sweet-delete-js-no-form/>
    <x-ajax-update-status-js-code url="{{ route('developer.updateStatus') }}"/>
    @if($viewDataTable)
        <x-data-table-plugins :jscode="true" />
    @endif


@endpush

