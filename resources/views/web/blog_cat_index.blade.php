@extends('web.layouts.app')
@section('content')

    <div class="row">

            <div class="col-lg-12">
                <h1 class="def_h1 mb-4">{{ $Category->name }}</h1>
            </div>

        {{ Breadcrumbs::render('blogCatList',$Category) }}
    </div>
    <textarea class="textarea_code">
                   {!! SEO::generate() !!}
               </textarea>

    <div class="row">
        @foreach($Posts as $Post)
            <div class="col-lg-3 ">
                <div class="card mb-3">
                    <div class="imgdiv">

                        <img src="{{getPhotoPath($Post->photo,"blog")}}"
                             class="img-fluid"
                             width="200"
                             height="100"
                             title="{{$Post->name}}"
                             alt="{{$Post->name}}"
                        >


{{--                        {!! \App\Helpers\AdminHelper::printWebImage($Post,'photo') !!}--}}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{route('blogView',[$Post->getCatName->slug,$Post->slug])}}">{{$Post->name}}</a></h5>
                        <p class="card-text">نُشرت بتاريخ {{ $Post->published_at  }}</p>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($Post->g_des,160) ?? 'No Des' }}</p>
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




@endsection
