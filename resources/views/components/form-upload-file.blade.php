@if(intval($thisfilterid) == 0)
    <div class="row">
        <x-form-select-arr  label="{{__('admin/def.form_selectFilterLable')}}" name="filter_id" colrow="col-lg-6"
                            sendvalue="{{old('filter_id')}}" :send-arr="$filterTypes"/>
    </div>
@else
    <input type="hidden" name="filter_id" value="{{ $thisfilterid }}">
@endif
<div class="row">
    <div class="{{$rowCol}}">
        <div class="form-group">
            <label class="col-md-12 col-form-label">{{$label}}
                @if($req)
                    <span class="required_Span">*</span>
                @endif
            </label>
            <div class="col-md-12">
                <input class="form-control @error($fileName) is-invalid @enderror" type="file" name="{{$fileName}}@if($multiple)[]@endif"  accept="{{$acceptFile}}"  @if($multiple) multiple @endif >
                @error($fileName)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ \App\Helpers\AdminHelper::error($message,$fileName,$label) }}</strong>
                </span>
                @enderror
            </div>
            @if($viewType == 'Edit')
                @if(isset($rowData->$fildName) and $rowData->$fildName != '')
                    <label class="col-md-12 col-form-label"> {{ $labelPhoto }}</label>
                    <div class="col-md-12 fileUploadCurrent">
                        <img  class="img-thumbnail rounded" src="{{defImagesDir($rowData->$fildName)}}">
                    </div>

                    @if($emptyphotourl != '#' )
                        <div class="row mt-3 mr-2 ml-2">
                            <x-action-button url="{{route($emptyphotourl,$rowData->id)}}" type="delete" :tip="true"/>
                        </div>
                    @endif

                @endif
            @endif
        </div>
    </div>
</div>
