@extends('admin.layouts.app')

@section('content')
    <x-breadcrumb-def :pageData="$pageData"/>



    <div class="content">
        <div class="container-fluid">
            <div class="row">

                @foreach($defPhoto as $file)

                    <div class="col-lg-3">


                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="card-title m-0"> {{pathinfo($file, PATHINFO_BASENAME)}}</h5>
                            </div>
                            <div class="card-body">


                                <p class="PhotoImageCard">
                                    <img src="{{ defImagesDir($file) }}">
                                </p>
                                <hr>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>




                @endforeach









            </div>

        </div>
    </div>


    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12" >


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
