@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"/>
    <x-mass.confirm-massage />

    <div class="content mb-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-9">
                    <h1 class="def_h1">{{ $Post->translate()->name }}</h1>
                </div>
                <div class="col-3 text-left">
                    <x-action-button  url="{{route('post.edit', $Post->id)}}" print-lable="{{__('admin/form.button_back')}}" size="s"  bg="dark" icon="fas fa-hand-point-left"  />
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @if(count($PostPhotos)>0)
                    <div class="row col-lg-12 hanySort">
                        @foreach($PostPhotos as $Photo)
                            <div class="col-lg-2 ListThisItam"  data-index="{{$Photo->id}}" data-position="{{$Photo->postion}}" >
                                <p class="PhotoImageCard"><img src="{{ defImagesDir($Photo->photo) }}"></p>
                                <div class="buttons mb-3" >
                                    @can('post_delete')
                                        <td class="tc"><x-action-button url="#" id="{{route('post.More_PhotosDestroy',$Photo->id)}}"  type="deleteSweet"/></td>
                                    @endcan
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


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <form  class="mainForm" action="{{route('post.More_PhotosAdd')}}" method="post"  enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="post_id" value="{{intval($Post->id)}}">
                        <input type="hidden" name="name" value="{{optional($Post->translate('en'))->name}}">
                        <x-form-upload-file view-type="Add" :row-data="$Post"
                                            :multiple="true"
                                            thisfilterid="4"
                        />
                        <div class="container-fluid">
                            <x-form-submit text="Add" />
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>





@endsection


@push('JsCode')
    <x-sweet-delete-js-no-form/>

    <script src="{{defAdminAssets('plugins/bootstrap/js/jquery-ui.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            $('.hanySort').sortable({

                update: function (event, ui) {
                    $(this).children().each(function (index) {
                        if ($(this).attr('data-position') != (index+1)) {
                            $(this).attr('data-position', (index+1)).addClass('updated');
                        }
                    });

                    var positions = [];
                    $('.updated').each(function () {
                        positions.push([$(this).attr('data-index'), $(this).attr('data-position')]);
                        $(this).removeClass('updated');
                    });

                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: '{{ route('post.sortPhotoSave') }}',
                        type: 'POST',
                        dataType: 'text',
                        data: {
                            update: 1,
                            positions: positions
                        },
                        success: function (response) {
                            console.log(response);
                        }
                    });
                }
            });
        });
    </script>
@endpush

