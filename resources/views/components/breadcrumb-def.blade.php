<section class="content-header">
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="def_breadcrumb_h1 text-lg font-weight-lighter">{{$pageData['TitlePage']}}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right text-md">
                <li class="breadcrumb-item"><a href="{{route('admin.Dashboard')}}">{{__('general.breadcrumb.home')}}</a></li>
                @if ($pageData['ViewType'] == 'List')
                    <li class="breadcrumb-item active">{{$pageData['ListPageName']}}</li>
                @elseif($pageData['ViewType'] == 'Add')
                    <li class="breadcrumb-item"><a href="{{$pageData['ListPageUrl']}}">{{$pageData['ListPageName']}}</a></li>
                    <li class="breadcrumb-item active">{{$pageData['AddPageName']}}</li>
                @elseif($pageData['ViewType'] == 'Edit')
                    <li class="breadcrumb-item"><a href="{{$pageData['ListPageUrl']}}">{{$pageData['ListPageName']}}</a></li>
                    <li class="breadcrumb-item active">{{$pageData['EditPageName']}}</li>
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

