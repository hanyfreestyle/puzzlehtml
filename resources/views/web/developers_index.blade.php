@extends('web.layouts.app')
@section('content')


    <div class="row">

        @foreach($Developers as $Developer)
            <div class="col-lg-4 ">

                <div class="card mb-3">
                    <div class="imgdiv">
                        {!! \App\Helpers\AdminHelper::printWebImage($Developer,'photo') !!}
                    </div>

                    <div class="card-body">
                        <h5 class="card-title"><a href="{{route('page-developer-view',$Developer->slug)}}">{{$Developer->name}}</a></h5>
                        <p class="UnitsInfo">
                            <span>Project {{$Developer->projects_count}}</span>
                            <span>Units {{$Developer->units_count}}</span>
                        </p>
                        <p class="card-text">{{ $Developer->g_des ?? 'No Des' }}</p>

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
