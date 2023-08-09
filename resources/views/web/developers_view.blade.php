@extends('web.layouts.app')
@section('content')

    <div class="row">
        {{ Breadcrumbs::render('developer_view',$Developer) }}
    </div>

    <div class="row developer-header mb-5">
        <div class="col-md-12 text-center ">
            <img src="{{getPhotoPath($Developer->photo,"developer")}}"
                 class="img-fluid"
                 width="200"
                 height="100"
                 title="{{$Developer->name}}"
                 alt="{{$Developer->name}}"
            >
        </div>

        @if(thisCurrentLocale() == 'ar')
            <h1 class="def_h1 text-center mt-3"> {{__('web/def.Compounds')}} {{$Developer->name}} </h1>
        @else
            <h1 class="def_h1 text-center mt-3"> {{$Developer->name}}  {{__('web/def.Compounds')}} </h1>
        @endif
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
                    >  {{$Projects->total()}} {{ __('web/def.Project') }}  </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link @if(isset($_GET['property_page'])) active @endif()"
                            id="pills-profile-tab"
                            data-bs-toggle="pill"
                            data-bs-target="#pills-profile"
                            type="button"
                            role="tab"
                            aria-controls="pills-profile"
                    >  {{$Units->total()}} {{ __('web/def.Units') }}</button>
                </li>

            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade @if(!isset($_GET['property_page'])) show active @endif()  " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="row">
                        @foreach($Projects as $Project)

                            <div class="col-lg-6 ">

                                <div class="card mb-3">
                                    <div class="imgdiv">
                                        <img src="{{getPhotoPath($Project->photo,"project")}}"
                                             class="img-fluid"
                                             width="200"
                                             height="100"
                                             title="{{$Project->name}}"
                                             alt="{{$Project->name}}"
                                        >

                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="#">{{$Project->name}}</a></h5>
                                        <p class="card-text">{{$Project->g_des}}</p>
                                        <p class="card-text">{{__('web/def.starting_from')}} {{ number_format($Project->price) }} <br>
                                            {{ $Project->locationName->name }}  </p>
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
                                        <img src="{{getPhotoPath($Unit->photo,"units")}}"
                                             class="img-fluid"
                                             width="200"
                                             height="100"
                                             title="{{$Unit->name}}"
                                             alt="{{$Unit->name}}"
                                        >
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="#">{{$Unit->name}}</a></h5>
                                        <p class="card-text">{{$Unit->g_des}}</p>
                                        <p class="card-text">
                                            {{ number_format($Unit->price) }}
                                            <br>
                                            {{ $Unit->locationName->name }}
                                        </p>

                                        <div class="info">
                                            <ul class="list-inline listing__attribute">
                                                <li><i class="fa fa-home"></i> {{ $Unit->property_type }}</li>
                                                <li><i class="fa fa-bed"></i> {{ $Unit->rooms }}</li>
                                                <li><i class="fa fa-bath"></i> {{ $Unit->baths }}</li>
                                                <li><i class="fa fa-arrows-alt-v"></i> {{ $Unit->area }}  م<sup>2</sup></li>
                                            </ul>
                                        </div>

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
            <div class="font-weight-bolder">{{ __('web/def.projects_news') }} {{$Developer->name}}</div>
            <hr>
            @foreach($Posts as $Post)
                <div class="blogLeft">
                    <div class="rightdiv">

                        <img src="{{getPhotoPath($Post->photo,"blog")}}"
                             class="img-fluid"
                             width="200"
                             height="100"
                             title="{{$Post->name}}"
                             alt="{{$Post->name}}"
                        >



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
