@extends('admin.layouts.app')

@section('content')
    <x-breadcrumb-def :pageData="$pageData"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <x-ui-card title="{{__('admin.seo_title')}}">

                    <x-form-input type="text"
                                  label="عربى"
                                  name="MIN_G_T"
                                  :horizontalLabel="true"
                                  :requiredSpan="true"
                                  value="{{old('MIN_G_T', env('MIN_G_T'))}}" inputclass="dir_ar"/>

                    <x-form-input type="text"
                                  label="En"
                                  name="MIN_G_T"
                                  :horizontalLabel="false"
                                  :requiredSpan="false"
                                  value="{{old('MIN_G_T', env('MIN_G_T'))}}" inputclass="dir_en"/>


                    <x-form-textarea
                        label="hany"
                    />



                    <x-form-submit text="Add" />
                </x-ui-card>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">


                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="m-0">Featured</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Special title treatment</h6>

                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>




                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div>


@endsection
