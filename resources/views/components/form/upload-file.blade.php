<div class="row">
    <div class="{{$rowCol}}">
        <div class="form-group">
            <label class="col-md-12 col-form-label">{{$label}}
                @if($req)
                    <span class="required_Span">*</span>
                @endif
            </label>
            <div class="col-md-12">
                <input class="form-control" type="file" name="{{$fileName}}@if($multiple)[]@endif"  accept="{{$acceptFile}}"  @if($multiple) multiple @endif  >
            </div>
            @if($viewType == 'Edit')
                @if(isset($rowData->$fildName))
                    <label class="col-md-12 col-form-label"> {{ $labelPhoto }}</label>
                    <div class="col-md-12 fileUploadCurrent">
                        <img  class="img-thumbnail rounded" src="{{defImagesDir($rowData->$fildName)}}">
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
