@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"/>

    <div class="content mb-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-9">
                    <h1 class="def_h1">{{ $Project->translate()->name }}</h1>
                </div>
                <div class="col-3 text-left">
                    <x-action-button  url="{{route('project.faq_list', $Project->id)}}" print-lable="{{__('admin/form.button_back')}}" size="s"  bg="dark" icon="fas fa-hand-point-left"  />
                </div>
            </div>
        </div>
    </div>

    <div class="content mb-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <x-ui-card :page-data="$pageData"  >


                        <form  class="mainForm" action="{{route('project.faq_update',intval($ProjectQuestion->id))}}" method="post" >
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $Project->id }}">
                            <div class="row">
                                @foreach ( config('app.lang_file') as $key=>$lang )
                                    <div class="col-lg-6 {{getColDir($key)}}">
                                        <x-trans-input

                                            label="{{__('admin/form.faq_question_'.$key)}} ({{ $key}})"
                                            name="{{ $key }}[question]"
                                            dir="{{ $key }}"
                                            reqname="{{ $key }}.question"
                                            value="{{old($key.'.question',$ProjectQuestion->translateOrNew($key)->question)}}"
                                        />
                                        <x-trans-text-area
                                            label="{{ __('admin/form.faq_answer_'.$key)}} ({{ ($key) }})"
                                            name="{{ $key }}[answer]"
                                            dir="{{ $key }}"
                                            reqname="{{ $key }}.answer"
                                            value="{{ old($key.'.answer',$ProjectQuestion->translateOrNew($key)->answer) }}"
                                        />

                                    </div>
                                @endforeach
                            </div>

                            <div class="container-fluid">
                                <x-form-submit text="{{$pageData['ViewType']}}" />
                            </div>
                        </form>

                    </x-ui-card>
                </div>

            </div>
        </div>
    </div>







@endsection


@push('JsCode')

@endpush

