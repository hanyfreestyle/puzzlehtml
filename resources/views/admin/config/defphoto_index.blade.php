@extends('admin.layouts.app')

@section('content')
    <x-breadcrumb-def :pageData="$pageData"/>

    <div class="content mb-3"><div class="container-fluid"><div class="row"><div class="col-12 text-left">
                    <x-action-button  url="{{route('config.defPhoto.create')}}"  type="add" size="m"   />
                    <x-action-button  url="{{route('config.defPhoto.sortDefPhotoList')}}" lable="{{__('admin.defPhoto.main.sortPhoto')}}" size="m"  bg="i" icon="fas fa-sort-amount-up"  />
                </div></div></div></div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <x-mass.confirm-massage />

                @if(count($rowData)>0)

                    <div class="row col-lg-12 hanySort">

                        @foreach($rowData as $row)

                            <div class="col-lg-3 ListThisItam"  data-index="{{$row->id}}" data-position="{{$row->postion}}" >
                                <div class="card card-primary card-outline">
                                    <div class="card-header"><h5 class="card-title m-0">{{$row->cat_id}} {{$row->id}}</h5></div>
                                    <div class="card-body">
                                        <p class="PhotoImageCard"><img src="{{defImagesDir($row->photo)}}"></p>
                                        <hr>
                                        <div class="row">
                                    <span class="ml-2">
                                    <x-action-button  url="{{route('config.defPhoto.edit',$row->id)}}"  type="edit" :tip="true" size="s"   />
                                    </span>
                                            <x-script.sweet-delete-button route-name="config.defPhoto.destroy" :row="$row" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>

                @else
                    <div class="col-lg-12">
                        <x-alert-massage type="nodata" />
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        {{ $rowData->links() }}
    </div>
@endsection

@push('JsCode')
    <x-script.sweet-delete-js-code/>
@endpush
