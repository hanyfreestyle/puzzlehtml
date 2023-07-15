<section class="content-header">
    <div class="container-fluid">



        <div class="row mb-2">
            <div class="col-sm-6">

                <h1 class="def_breadcrumb_h1 text-lg font-weight-lighter">
                    @if($butView)<a href="{{route('admin.Dashboard')}}"><i class="fa fa-home"></i></a> @endif {{$pageData['TitlePage']}}
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right text-md">
                    @if($butView == false)
                        <li class="breadcrumb-item"><a href="{{route('admin.Dashboard')}}">{{__('general.breadcrumb.home')}}</a></li>
                    @endif

                    @if ($pageData['ViewType'] == 'List')


                    @elseif($pageData['ViewType'] == 'Add')
                        @if($butView)
                            <x-action-button  url="{{$pageData['ListPageUrl']}}" print-lable="{{$pageData['ListPageName']}}" size="s"  bg="p"   />
                        @else
                            <li class="breadcrumb-item"><a href="{{$pageData['ListPageUrl']}}">{{$pageData['ListPageName']}}</a></li>
                            <li class="breadcrumb-item active">{{$pageData['AddPageName']}}</li>
                        @endif
                    @elseif($pageData['ViewType'] == 'Edit')
                        @if($butView)
                            <x-action-button  url="{{$pageData['ListPageUrl']}}" print-lable="{{$pageData['ListPageName']}}" size="s"  bg="p"   />
                        @else
                            <li class="breadcrumb-item"><a href="{{$pageData['ListPageUrl']}}">{{$pageData['ListPageName']}}</a></li>
                            <li class="breadcrumb-item active">{{$pageData['EditPageName']}}</li>
                        @endif

                    @elseif($pageData['ViewType'] == 'Page')
                        @if(isset($pageData['BackPage']))
                            <li class="breadcrumb-item"><a href="{{$pageData['BackPageUrl']}}">{{$pageData['BackPage']}}</a></li>
                        @endif
                        <li class="breadcrumb-item active">{{$pageData['TitlePage']}}</li>
                    @endif

                </ol>
            </div>
        </div>
    </div>
</section>

