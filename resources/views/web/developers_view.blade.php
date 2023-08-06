@extends('web.layouts.app')
@section('content')

    <div class="row developer-header mb-5">
        <div class="col-md-12 text-center ">
            {!! \App\Helpers\AdminHelper::printWebImage($Developer,'photo') !!}
        </div>

        <h1 class="def_h1 text-center mt-3">كمبوندات {{$Developer->name}} </h1>

    </div>







    <div class="row">
        <div class="col-md-8">

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link @if(!isset($_GET['property_page'])) active @endif() "
                            id="pills-home-tab"
                            data-bs-toggle="pill"
                            data-bs-target="#pills-home"
                            type="button"
                            role="tab"
                            aria-controls="pills-home"
                        {{--                            aria-selected="true"--}}
                    >  Project {{$Projects->total()}} </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link @if(isset($_GET['property_page'])) active @endif()"
                            id="pills-profile-tab"
                            data-bs-toggle="pill"
                            data-bs-target="#pills-profile"
                            type="button"
                            role="tab"
                            aria-controls="pills-profile"
                        {{--                            aria-selected="false"--}}
                    > Units {{$Units->total()}}</button>
                </li>

            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade @if(!isset($_GET['property_page'])) show active @endif()  " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="row">
                        @foreach($Projects as $Project)
                            <div class="col-lg-6 ">

                                <div class="card mb-3">
                                    <div class="imgdiv">
                                        {!! \App\Helpers\AdminHelper::printWebImage($Project,'photo') !!}
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="#">{{$Project->name}}</a></h5>
                                        <p class="card-text">{{$Project->g_des}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-5">
                        @if($Projects instanceof \Illuminate\Pagination\AbstractPaginator)
                            {{ $Projects->links() }}
                        @endif

                    </div>

                </div>
                <div class="tab-pane fade @if(isset($_GET['property_page'])) show active @endif() " id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">


                    <div class="row">
                        @foreach($Units as $Unit)
                            <div class="col-lg-6 ">

                                <div class="card mb-3">
                                    <div class="imgdiv">
                                        {!! \App\Helpers\AdminHelper::printWebImage($Unit,'photo') !!}
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="#">{{$Unit->name}}</a></h5>
                                        <p class="card-text">{{$Unit->g_des}}</p>
                                    </div>
                                </div>


                            </div>
                        @endforeach
                    </div>



                    <div class="d-flex justify-content-center mt-5">
                        @if($Units instanceof \Illuminate\Pagination\AbstractPaginator)
                            {{ $Units->links() }}
                        @endif
                    </div>

                </div>

            </div>

        </div>
        <div class="col-6 col-md-4">
        <div class="font-weight-bolder">  أخبار مشاريع كمبوندات {{$Developer->name}}</div>
            <hr>
            @foreach($Posts as $Post)
                <div class="blogLeft">
                    <div class="rightdiv">
                        {!! \App\Helpers\AdminHelper::printWebImage($Post,'photo') !!}
                    </div>
                    <div class="leftdiv">
                        <p><a href="#">{{ $Post->name }}</a></p>
                        <p>{{ $Post->published_at  }}</p>
                    </div>

                </div>
            @endforeach
        </div>
    </div>



    <hr>
    <div class="row">
        <div class="col-md-12">


            {!!  $Developer->des !!}
        </div>
    </div>







@endsection
