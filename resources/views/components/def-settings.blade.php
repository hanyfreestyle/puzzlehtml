<form class="mainForm pb-0" action="{{route('config.model.update')}}" method="post">
    @csrf
    <input type="hidden" value="{{$modelname}}" name="model_id">
    <div class="row">
        <input type="hidden" value="{{$modelname}}" name="model_id">

        <x-form-input label="{{__('admin/config/settings.set_perpage')}}" name="{{$modelname}}_perpage" :requiredSpan="true" colrow="col-lg-3" dir="ar"
                      value="{{old($modelname.'_perpage',\App\Helpers\AdminHelper::arrIsset($modelSettings,$modelname.'_perpage',10))}}" inputclass="dir_ar" />


        <x-form-select-arr  label="{{__('admin/config/settings.set_dataTable')}}" name="{{$modelname}}_datatable" colrow="col-lg-3"
                            sendvalue="{{old($modelname.'_datatable',\App\Helpers\AdminHelper::arrIsset($modelSettings,$modelname.'_datatable',1))}}" select-type="selActive"/>

        <x-form-select-arr  label="{{__('admin/config/settings.set_orderBy')}}" name="{{$modelname}}_orderby" colrow="col-lg-3" :send-arr="$OrderByArr"
                            sendvalue="{{old($modelname.'_orderby',\App\Helpers\AdminHelper::arrIsset($modelSettings,$modelname.'_orderby',0))}}" select-type="normal"/>





        <x-form-select-arr  label="{{__('admin/def.form_selectFilterLable')}}" name="{{$modelname}}_filterid" colrow="col-lg-3"
                            sendvalue="{{old($modelname.'_filterid',\App\Helpers\AdminHelper::arrIsset($modelSettings,$modelname.'_filterid',0))}}" :send-arr="$filterTypes"/>

        {{$slot}}
    </div>
    <div class="container-fluid"><x-form-submit text="Edit" /></div>
</form>

