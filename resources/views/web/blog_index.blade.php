@extends('web.layouts.app')
@section('content')


    <div class="row">
        @foreach($Posts as $Post)
            <div class="col-lg-3 ">
                <div class="card mb-3">
                    <div class="imgdiv">
                        {!! \App\Helpers\AdminHelper::printWebImage($Post,'photo') !!}
                    </div>
                    <div class="card-body">
{{--                        <p>{{ $Post->id  }}</p>--}}
                        <h5 class="card-title"><a href="{{route('blogView',[$Post->getCatName->slug,$Post->slug])}}">{{$Post->name}}</a></h5>
                        <p class="card-text">نُشرت بتاريخ {{ $Post->published_at  }}</p>
{{--                        <p class="card-text">{{ \Illuminate\Support\Str::limit($Post->g_des,160) ?? 'No Des' }}</p>--}}
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