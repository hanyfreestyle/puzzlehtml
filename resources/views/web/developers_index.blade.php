@extends('web.layouts.app')
@section('content')


    <div class="row">

        @foreach($Developers as $Developer)
            <div class="col-lg-4 ">
                <div class="card mb-3 DeveloperCard">
                    <div class="bg-image hover-overlay ripple text-center">
                        {!! \App\Helpers\AdminHelper::printWebImage($Developer,'photo') !!}

                    </div>
                    <div class="card-body ">
                        <h5 class="card-title"><a href="{{route('page-developer-view',$Developer->slug)}}">{{$Developer->name}}</a></h5>
{{--                        <h3>{{$Developer->project_count_count}}</h3>--}}
                        <p class="card-text">{{$Developer->g_des}}</p>
{{--                        <a href="#" class="btn btn-primary">Button</a>--}}
                    </div>
                </div>
            </div>

        @endforeach




    </div>

    <div class="d-flex justify-content-center">
        @if($Developers instanceof \Illuminate\Pagination\AbstractPaginator)
            {{ $Developers->links() }}
        @endif

    </div>







@endsection
