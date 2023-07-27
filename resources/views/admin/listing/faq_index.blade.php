@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"/>
    <x-mass.confirm-massage />

    <div class="content mb-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-9">
                    <h1 class="def_h1">{{ $Project->translate()->name }}</h1>
                </div>
                @if($pageData['ViewType'] == 'List')
                    <div class="col-3 text-left">
                        <x-action-button  url="{{route('project.faq_create', $Project->id)}}"  type="add"  size="s"  />
                        <x-action-button  url="{{route('project.edit', $Project->id)}}" print-lable="{{__('admin/form.button_back')}}" size="s"  bg="dark" icon="fas fa-hand-point-left"  />
                    </div>
                @endif
                @if($pageData['ViewType'] == 'deleteList')
                    <div class="col-3 text-left">
                        <x-action-button  url="{{route('project.faq_list', $Project->id)}}" print-lable="{{__('admin/form.button_back')}}" size="s"  bg="dark" icon="fas fa-hand-point-left"  />
                    </div>
                @endif

            </div>
        </div>
    </div>

    <section class="div_data">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card pb-3">
                        <div class="card-header">
                            <h3 class="card-title">Question</h3>
                            @if($pageData['ViewType'] == 'List')
                                @if($Trashed > 0 )
                                    @can('project_restore')
                                        <a href="{{route('project.faq_SoftDelete',$Project->id)}}" class="btn btn-sm btn-danger float-left">{{ __('admin/page.del_restor_but') }}</a>
                                    @endcan
                                @endif
                            @endif
                        </div>

                        @if(count($ProjectQuestion)>0)
                            <div class="card-body">
                                <table class="table table-hover" >
                                    <thead>
                                    <tr>
                                        <th class="TD_20">#</th>
                                        <th class="TD_350">{{__('admin/form.faq_question_ar')}}</th>
                                        <th class="TD_350">{{__('admin/form.faq_answer_ar')}}</th>

                                        @if($pageData['ViewType'] == 'deleteList')
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        @else
                                            <th class="TD_350">{{__('admin/form.faq_question_en')}}</th>
                                            <th class="TD_350">{{__('admin/form.faq_answer_en')}}</th>
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
                                    @foreach($ProjectQuestion as $Question)
                                        <tr>
                                            <td>{{$Question->id}}</td>
                                            <td>{{optional($Question->translate('ar'))->question}}</td>
                                            <td>{{optional($Question->translate('ar'))->answer}}</td>

                                            @if($pageData['ViewType'] == 'deleteList')
                                                <td>{{$Question->deleted_at}}</td>
                                                <td class="tc"><x-action-button url="{{route('project.faq_restore',$Question->id)}}" type="restor" /></td>
                                                <td class="tc"><x-action-button url="#" id="{{route('project.faq_force',$Question->id)}}" type="deleteSweet"/></td>

                                            @else
                                                <td>{{optional($Question->translate('en'))->question}}</td>
                                                <td>{{optional($Question->translate('en'))->answer}}</td>
                                                @can('project_edit')
                                                    <td class="tc"><x-action-button url="{{route('project.faq_edit',$Question->id)}}" type="edit" :tip="true" /></td>
                                                @endcan
                                                @can('project_delete')
                                                    <td class="tc"><x-action-button url="#" id="{{route('project.faq_destroy',$Question->id)}}" :tip="true" type="deleteSweet"/></td>
                                                @endcan
                                            @endif

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="col-lg-12 pr-4 pl-4">
                                <x-alert-massage type="nodata" />
                            </div>
                        @endif
                    </div>


                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            @if($ProjectQuestion instanceof \Illuminate\Pagination\AbstractPaginator)
                {{ $ProjectQuestion->links() }}
            @endif
        </div>

    </section>


    {{--    <div class="content">--}}
    {{--        <div class="container-fluid">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-lg-12">--}}

    {{--                    <form  class="mainForm" action="{{route('project.More_PhotosAdd')}}" method="post"  enctype="multipart/form-data">--}}
    {{--                        @csrf--}}

    {{--                        <input type="hidden" name="listing_id" value="{{intval($Project->id)}}">--}}
    {{--                        <input type="hidden" name="name" value="{{ $Project->slug }}">--}}
    {{--                        <x-form-upload-file view-type="Add" :row-data="$Project"--}}
    {{--                                            :multiple="true"--}}
    {{--                                            thisfilterid="4"--}}
    {{--                        />--}}
    {{--                        <div class="container-fluid">--}}
    {{--                            <x-form-submit text="Add" />--}}
    {{--                        </div>--}}
    {{--                    </form>--}}

    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}





@endsection


@push('JsCode')
    <x-sweet-delete-js-no-form/>
@endpush

