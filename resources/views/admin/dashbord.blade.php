@extends('admin.layouts.app')

@section('content')


        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->


        <div class="content">
            <div class="container-fluid">


                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <x-action-button url="{{ route('admin.Dashboard.Update')  }}" bg="w" print-lable="تحديث البيانات " />

                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-3">
                        <x-dashboard-count name="{{ __('admin/menu.post') }}"
                                           :card-count="$PostsCount"
                                           url="post"
                                           lable="{{__('admin/def.post')}}" />
                    </div>
                    <div class="col-lg-3">
                        <x-dashboard-count name="{{ __('admin/menu.developer') }}"
                                           :card-count="$DevelopersCount"
                                           url="developer"
                                           lable="مطور" />
                    </div>

                    <div class="col-lg-3">
                        <x-dashboard-count name="{{ __('admin/menu.project') }}"
                                           :card-count="$ProjectsCount"
                                           url="project"
                                           lable="مشروع" />
                    </div>


                    <div class="col-lg-3">
                        <x-dashboard-count name="وحدات المشاريع"
                                           :card-count="$ProjectUnitsCount"
                                           url="project.projectUnit"
                                           lable="وحدة" />
                    </div>


                    <div class="col-lg-3">
                        <x-dashboard-count name="{{ __('admin/menu.unit') }}"
                                           :card-count="$ForSaleCount"
                                           url="unit"
                                           lable="وحدة" />
                    </div>





                </div>
            </div>
        </div>


@endsection

@push('JsCode')
    <!-- OPTIONAL SCRIPTS -->
    <script src="{{defAdminAssets('plugins/chart.js/Chart.min.js')}}"></script>


    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{defAdminAssets('js/pages/dashboard3.js')}}"></script>
@endpush
