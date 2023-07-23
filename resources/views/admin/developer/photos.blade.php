@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"/>
    <x-mass.confirm-massage />

    <div class="content mb-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-9">
                    <h1 class="def_h1">{{ $Developer->translate()->name }}</h1>
                </div>
                <div class="col-3 text-left">
                    <x-action-button  url="{{route('developer.edit', $Developer->id)}}" print-lable="{{__('admin/form.button_back')}}" size="s"  bg="dark" icon="fas fa-hand-point-left"  />
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @if(count($DeveloperPhotos)>0)
                    <div class="row col-lg-12 hanySort">
                        @foreach($DeveloperPhotos as $Photo)
                            <div class="col-lg-2 ListThisItam"  data-index="{{$Photo->id}}" data-position="{{$Photo->postion}}" >
                                <p class="PhotoImageCard"><img src="{{ defImagesDir($Photo->photo) }}"></p>
                                <div class="buttons mb-3" >
                                    @can('developer_delete')
                                        <td class="tc"><x-action-button url="#" id="{{route('developer.More_PhotosDestroy',$Photo->id)}}"  type="deleteSweet"/></td>
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

                    <form  class="mainForm" action="{{route('developer.More_PhotosAdd')}}" method="post"  enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="developer_id" value="{{intval($Developer->id)}}">
                        <input type="hidden" name="name" value="{{$Developer->translate('en')->name}}">
                        <x-form-upload-file view-type="Add" :row-data="$Developer"
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
                        url: '{{ route('developer.sortPhotoSave') }}',
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
