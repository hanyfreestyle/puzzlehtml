<div class="form-group">
    <label class="col-form-label font-weight-light">{{$label}}
       @if($reqspan)
            <span class="required_Span">*</span>
       @endif
    </label>
    <input type="text" class="form-control dir_{{$dir}} @error($reqname) is-invalid is_invalid_{{$dir}} @enderror"
           name="{{$name}}"
           value="{{$value}}">

    @if($errors->has($reqname))
        <span class="invalid-feedback" role="alert">
        <strong>{{ str_replace($newreqname, $label, $errors->first($reqname)) }}</strong>
        </span>
    @endif
</div>
