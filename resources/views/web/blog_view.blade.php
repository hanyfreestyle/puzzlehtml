@extends('web.layouts.app')
@section('content')

    <div class="row">

        <div class="col-lg-12">
            <h1 class="def_h1 mb-4">{{ $Post->name }}</h1>
        </div>
        {{ Breadcrumbs::render('post_view',$Category,$Post) }}
    </div>





    <div class="row">
        <div class="col-lg-8">
            <div class="col-lg-12">
                <div class="imgdiv_post">

                    <img src="{{getPhotoPath($Post->photo,"blog")}}"
                         class="img-fluid"
                         width="200"
                         height="100"
                         title="{{$Post->name}}"
                         alt="{{$Post->name}}"
                    >

                </div>
            </div>



            @if($project_tag != null)
                <div class="col-lg-12 project_post">
                    {{$project_tag->name}}
                    <br>
                    {{$project_tag->g_des}}



                    <div class="row mt-3">
                        <div class="col-lg-4">
                            <p class="card-text">تبداء من {{ number_format($project_tag->price) }}</p>
                            <p class="card-text">الحالة {{ project_status($project_tag->status)  }}</p>
                            <p class="card-text">تاريخ التسليم {{ $project_tag->delivery_date }}</p>
                            <p class="card-text"> بواسطة <a href="{{route('page-developer-view',$project_tag->developerName->slug)}}">{{ $project_tag->developerName->name }}</a> </p>
                        </div>

                        <div class="col-lg-8">
                            @if($project_tag->youtube_url != null)
                                <iframe width="420" height="315"
                                        src="https://www.youtube.com/embed/{{$project_tag->youtube_url}}">
                                </iframe>
                            @endif
                        </div>
                    </div>



                </div>
            @endif
            <div class="col-lg-12">
            {!! $Post->des !!}
            </div>

        </div>



        <div class="col-lg-4">
            @if($relatedProjects != null)

                <p> أفضل الكمبوندات في {{ $Post->getLoationName->name }} </p>
                @foreach($relatedProjects as $relatedProject)
                    <div class="blogLeft">
                        <div class="rightdiv">

                            <img src="{{getPhotoPath($relatedProject->photo,"project")}}"
                                 class="img-fluid"
                                 width="200"
                                 height="100"
                                 title="{{$Post->name}}"
                                 alt="{{$Post->name}}"
                            >

                        </div>
                        <div class="leftdiv">
                            <p><a href="#">{{ $relatedProject->name }}</a>
                                <br>
                            {{ number_format($relatedProject->price)  }}
                                <br>
                             <i class="fa fa-map-marker-alt"></i><span class="text">{{$relatedProject->locationName->name}}</span>

                            </p>
                        </div>

                    </div>


                @endforeach
            @endif
        </div>
    </div>
@endsection
