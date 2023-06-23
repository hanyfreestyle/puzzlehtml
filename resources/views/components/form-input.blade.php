<div class="form-group {{($horizontalLabel) ? 'row' : '' }} {{$topclass}}">
    @if ($label != '')
        <div class="{{($horizontalLabel) ? 'col-sm-5' : '' }}">
            <label class="col-form-label {{($horizontalLabel) ? 'font-weight-normal' : '' }}" for="{{$id}}">{{$label}}
                @if($requiredSpan)
                    <span class="required_Span">*</span>
                @endif
            </label>
        </div>

    @endif
    <div class="{{($horizontalLabel) ? 'col-sm-7' : '' }}">
        <input type="{{$type}}" class="{{$inputclass}} form-control @error($name) is-invalid @enderror"
               id="{{$id}}" name="{{$name}}" placeholder="{{$placeholder}}"
               @if(!is_null($step))
               step="{{$step}}"
               @endif
               @if(!is_null($max))
               max="{{$max}}"
               @endif
               @if(!is_null($maxlength))
               maxlength="{{$maxlength}}"
               @endif
               @if(!is_null($pattern))
               pattern="{{$pattern}}"
               @endif
               value="{{$value}}"
               {{($required) ? 'required' : '' }}
               {{($disabled) ? 'disabled' : '' }}
               dir="auto"
        >
        @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ \App\Helpers\AdminHelper::error($message,$name,$label) }}</strong>
        </span>
        @enderror
    </div>

</div>


