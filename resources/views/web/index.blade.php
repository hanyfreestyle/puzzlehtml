@extends('web.layouts.app')
@section('content')

        <div class="row justify-content-md-center">
            <div class="col-lg-12">
               <textarea class="textarea_code">
                   {!! SEO::generate() !!}
               </textarea>
            </div>

        </div>


        <div class="row">
            <div class="col-lg-6">



            </div>

            <div class="col-lg-6">

            </div>
        </div>




@endsection
