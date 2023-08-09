@extends('web.layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="def_h1 mb-4">{{  __('web/menu.developer') }}</h1>
        </div>
        {{ Breadcrumbs::render('developer_list') }}
    </div>

    <div class="row">

        @foreach($Developers as $Developer)
            <div class="col-lg-3 ">

                <div class="card mb-3">
                    <div class="imgdiv">
{{--                        {!! \App\Helpers\AdminHelper::printWebImage($Developer,'photo',"logo") !!}--}}
                        <img src="{{getPhotoPath($Developer->photo,"developer")}}"
                             class="img-fluid"
                             width="200"
                             height="100"
                             title="{{$Developer->name}}"
                             alt="{{$Developer->name}}"
                        >

                    </div>

                    <div class="card-body">
                        <h5 class="card-title"><a href="{{route('page-developer-view',$Developer->slug)}}">{{$Developer->name}}</a></h5>
                        <p class="UnitsInfo">
                            <span>{{$Developer->projects_count}} {{__('web/def.Project')}} </span>
                            <span>{{$Developer->units_count}} {{__('web/def.Units')}}</span>
                        </p>
                        <p class="card-text">{{ $Developer->seoDes() ?? 'No Des' }}</p>

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
