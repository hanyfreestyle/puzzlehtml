@extends('web.layouts.app')
@section('content')

    {{ Breadcrumbs::render('blog') }}

    <div class="row">
        @foreach($Posts as $Post)
            <div class="col-lg-3 ">
                <div class="card mb-3">
                    <div class="imgdiv">
{{--                        {!! \App\Helpers\AdminHelper::printWebImage($Post,'photo') !!}--}}
                        <img src="{{getPhotoPath($Post->photo,"blog")}}"
                             class="img-fluid"
                             width="200"
                             height="100"
                             title="{{$Post->name}}"
                             alt="{{$Post->name}}"
                        >

                    </div>
                    <div class="card-body">
{{--                        <p>{{ $Post->id  }}</p>--}}
                        <h5 class="card-title"><a href="{{route('blogView',[$Post->getCatName->slug,$Post->slug])}}">{{$Post->name}}</a></h5>
                        <p class="card-text"> {{ __('web/def.published_at') }} {{ $Post->published_at  }}</p>

                        <p class="card-text">{!! $Post->seoDes() !!}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        @if($Posts instanceof \Illuminate\Pagination\AbstractPaginator)
            {{ $Posts->links() }}
        @endif
    </div>

    <hr>


    <div class="row">
        @foreach($Categories as $Category)
            <div class="col-lg-4">
                <a href="{{route('blogCatList',$Category->slug)}}">{{ $Category->name }}  ({{  $Category->post_count_count}}) </a>
            </div>
        @endforeach
    </div>

@endsection
