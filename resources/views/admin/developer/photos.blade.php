@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"/>
    <div class="content mb-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-left">
                    @can('defPhoto_add')
                        <x-action-button  url="{{route('config.defPhoto.create')}}"  type="add" size="m"   />
                    @endcan
                    @can('defPhoto_edit')
                        <x-action-button  url="{{route('config.defPhoto.sortDefPhotoList')}}" print-lable="{{__('admin/form.button_sort')}}" size="m"  bg="i" icon="fas fa-sort-amount-up"  />
                    @endcan
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
                                <p class="PhotoImageCard"><img src="{{ Update_defImagesDir($Photo->photo) }}"></p>
                            </div>
                        @endforeach


{{--                        @foreach($Developer->getMorePhoto as $onePhoto)--}}
{{--                            <div class="col-lg-2 ListThisItam"  data-index="{{$onePhoto->id}}" data-position="{{$onePhoto->postion}}" >--}}
{{--                                <p class="PhotoImageCard"><img src="{{ Update_defImagesDir($onePhoto->photo) }}"></p>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
                    </div>
                @else
                    <div class="col-lg-12">
                        <x-alert-massage type="nodata" />
                    </div>
                @endif
            </div>
        </div>
    </div>




@endsection


@push('JsCode')

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
