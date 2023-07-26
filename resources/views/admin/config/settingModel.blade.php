@extends('admin.layouts.app')

@section('content')
    <x-breadcrumb-def :pageData="$pageData"/>
    <x-mass.confirm-massage />

    <div class="content mb-3">
        <div class="container-fluid pr-3 pl-3">
            <div class="row">
                <div class="col-12 col-sm-12">


                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">

                        </div>
                        <div class="card-body ">
                            <div class="row">

                                <div class="col-lg-12 pt-3">
                                    <div class="alert alert-dark alert-dismissible">
                                        {{ __('admin/menu.category') }}
                                    </div>
                                    <x-def-settings modelname="category">
                                    </x-def-settings>
                                </div>

                                <div class="col-lg-12 pt-3">
                                    <div class="alert alert-dark alert-dismissible">
                                        {{ __('admin/menu.amenity') }}
                                    </div>
                                    <x-def-settings modelname="amenity">
                                    </x-def-settings>
                                </div>


                                <div class="col-lg-12 pt-3">
                                    <div class="alert alert-dark alert-dismissible">
                                        {{ __('admin/menu.location') }}
                                    </div>
                                    <x-def-settings modelname="location">
                                    </x-def-settings>
                                </div>


                                <div class="col-lg-12 pt-3">
                                    <div class="alert alert-dark alert-dismissible">
                                        {{ __('admin/menu.developer') }}
                                    </div>
                                    <x-def-settings modelname="developer">
                                    </x-def-settings>
                                </div>


                                <div class="col-lg-12 pt-3">
                                    <div class="alert alert-dark alert-dismissible">
                                        {{ __('admin/menu.post') }}
                                    </div>
                                    <x-def-settings modelname="post">
                                    </x-def-settings>
                                </div>


                                <div class="col-lg-12 pt-3">
                                    <div class="alert alert-dark alert-dismissible">
                                        {{ __('admin/menu.project') }}
                                    </div>
                                    <x-def-settings modelname="project">
                                    </x-def-settings>
                                </div>


                                <div class="col-lg-12 pt-3">
                                    <div class="alert alert-dark alert-dismissible">
                                        {{ __('admin/menu.unit') }}
                                    </div>
                                    <x-def-settings modelname="unit">
                                    </x-def-settings>
                                </div>


                            </div>






                            <hr>

                            <hr>




                        </div>

                    </div>



                </div>

            </div>

        </div>
    </div>







@endsection
