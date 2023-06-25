<div class="form-group {{($horizontalLabel) ? 'row' : '' }}  {{$topclass}}">
    @if ($label != '')
        <div class="{{($horizontalLabel) ? 'col-sm-4' : '' }}">
            <label class="font-weight-light {{($horizontalLabel) ? 'font-weight-normal' : '' }}" for="{{$id}}">{{$label}}
                @if($requiredSpan)
                    <span class="required_Span">*</span>
                @endif
            </label>
        </div>
    @endif
    <div class="{{($horizontalLabel) ? 'col-sm-8' : '' }}">
    <textarea class="form-control {{$inputclass}} @error($name) is-invalid @enderror"
              rows="{{$rows}}" id="{{$id}}" name="{{$name}}"
              placeholder="{{$placeholder}}"

    {{($required) ? 'required' : '' }}
        {{($disabled) ? 'disabled' : '' }}
    >{{$value}}</textarea>

        @error($name)
        <span class="invalid-feedback" role="alert">
            <strong> {{ \App\Helpers\AdminHelper::error($message,$name,$label)  }}</strong>
        </span>
        @enderror
    </div>
</div>
