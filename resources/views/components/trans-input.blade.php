<div class="form-group">
    @if($placeholder == false)
        <label class="def_form_label col-form-label label_{{$dir}} font-weight-light">{{$label}}
            @if($reqspan)
                <span class="required_Span">*</span>
            @endif
        </label>
    @endif
    <input type="text" class="form-control dir_{{$dir}} @error($reqname) is-invalid is_invalid_{{$dir}} @enderror"
           name="{{$name}}"
           placeholder="{{$placeholderPrint}}"
           value="{{$value}}">

    @if($errors->has($reqname))
        <span class="invalid-feedback" role="alert">
        <strong>{{ str_replace($newreqname, $label, $errors->first($reqname)) }}</strong>
        </span>
    @endif
</div>
