<div class="form-group">
    @if($placeholder == false)
        <label class="def_form_label font-weight-light label_{{$dir}} ">{{$label}}
            @if($reqspan)
                <span class="required_Span">*</span>
            @endif
        </label>

    @endif

    <textarea class="form-control dir_{{$dir}} @error($reqname) is-invalid is_invalid_area_{{$dir}} @enderror" rows="5"
              name="{{$name}}"
              placeholder="{{$placeholderPrint}}"
    >{{$value}}</textarea>

    @if($errors->has($reqname))
        <span class="invalid-feedback" role="alert">
        <strong>{{ str_replace($newreqname, $label, $errors->first($reqname)) }}</strong>
        </span>
    @endif

</div>
