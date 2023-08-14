@extends('admin.layouts.app')
@php
    $viewDataTable = \App\Helpers\AdminHelper::arrIsset($modelSettings,'post_datatable',0) ;
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
                <div class="col-lg-12">

                     <div class="row"><div class="col-lg-12 mb-2">
                            <x-action-button url="{{ route('post.noPhoto')  }}" print-lable="لا توجد صورة " />
                            <x-action-button url="{{ route('post.slugErr')  }}" print-lable="رابط متكرر " />
                            <x-action-button url="{{ route('post.noAr')  }}" print-lable="لا يوجد محتوى عربى  " />
                            <x-action-button url="{{ route('post.noEn')  }}" print-lable="لا يوجد محتوى انجليزى  " />
                            <x-action-button url="{{ route('post.unActive')  }}" print-lable="غير فعال  " />
                        </div> </div>


                    <x-ui-card  :page-data="$pageData" >
                        <x-mass.confirm-massage/>

                        @if(count($Posts)>0)
                            <div class="card-body table-responsive p-0">
                                <table {!! $tableHeader !!} >
                                    <thead>
                                    <tr>
                                        <th class="TD_20">#</th>
                                        <th class="TD_350">{{__('admin/def.form_name_ar')}}</th>
                                        <th class="TD_350">{{__('admin/def.form_name_en')}}</th>

                                        @if($pageData['ViewType'] == 'deleteList')
                                            <th>{{ __('admin/page.del_date') }}</th>
                                            <th></th>
                                            <th></th>
                                            <th class="tc">{{__('admin/def.photo')}}</th>
                                        @else
                                            {{--                                            <th>{{__('admin/def.status')}}</th>--}}
                                            <th></th>
                                            <th class="tc">{{__('admin/def.photo')}}</th>
                                            @can('post_edit')
                                                <th class="tbutaction"></th>
                                            @endcan
                                            @can('post_delete')
                                                <th class="tbutaction"></th>
                                            @endcan
                                        @endif

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($Posts as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>

                                            <td>{{optional($row->translate('ar'))->name}}</td>
                                            <td>{{optional($row->translate('en'))->name}}</td>



                                            @if($pageData['ViewType'] == 'deleteList')
                                                <td>{{$row->deleted_at}}</td>
                                                <td class="tc"><x-action-button url="{{route('post.restore',$row->id)}}" type="restor" /></td>
                                                <td class="tc"><x-action-button url="#" id="{{route('post.force',$row->id)}}" type="deleteSweet"/></td>
                                                <td class="tc">{!! \App\Helpers\AdminHelper::printTableImage($row,'photo') !!} </td>
                                            @else
                                                <td>
                                                    @if(count($row->getMorePhoto) == '0')
                                                        <x-action-button url="{{route('post.More_Photos',$row->id)}}" type="morePhoto" :tip="true" bg="dark" />
                                                    @else
                                                        <x-action-button url="{{route('post.More_Photos',$row->id)}}" type="morePhoto" :tip="true" />
                                                    @endif

                                                </td>
                                                {{--<td class="tc"> <x-ajax-update-status-but :row="$row" role="post_edit" /> </td>--}}
                                                <td class="tc">{!! \App\Helpers\AdminHelper::printTableImage($row,'photo') !!} </td>
                                                @can('post_edit')
                                                    <td class="tc"><x-action-button url="{{route('post.edit',$row->id)}}" type="edit" :tip="false" /></td>
                                                @endcan
                                                @can('post_delete')
                                                    <td class="tc"><x-action-button url="#" id="{{route('post.destroy',$row->id)}}" type="deleteSweet"/></td>
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
            @if($Posts instanceof \Illuminate\Pagination\AbstractPaginator)
                {{ $Posts->links() }}
            @endif

        </div>


    </section>
@endsection

@push('JsCode')
    <x-sweet-delete-js-no-form/>
    <x-ajax-update-status-js-code url="{{ route('post.updateStatus') }}"/>
    @if($viewDataTable)
        <x-data-table-plugins :jscode="true" />
    @endif
@endpush


