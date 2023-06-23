<div class="form-group {{($horizontalLabel) ? 'row' : '' }}  {{$topclass}}">
    @if ($label != '')
        <div class="{{($horizontalLabel) ? 'col-sm-4' : '' }}">
            <label class="{{($horizontalLabel) ? 'font-weight-normal' : '' }}" for="{{$id}}">{{$label}}
                @if($requiredSpan)
                    <span class="required_Span">*</span>
                @endif
            </label>
        </div>
    @endif
    <div class="{{($horizontalLabel) ? 'col-sm-8' : '' }}">
    <textarea class="form-control {{$inputclass}} @error($name) is-invalid @enderror"
              id="{{$id}}" name="{{$name}}"
              placeholder="{{$placeholder}}"
              dir="auto"
    {{($required) ? 'required' : '' }}
        {{($disabled) ? 'disabled' : '' }}
    >{{$slot}}</textarea>
        @error($name)
        <span class="invalid-feedback" role="alert">
            <strong> {{ \App\Helpers\AdminHelper::error($message,$name,$label)  }}</strong>
        </span>
        @enderror
    </div>
</div>
@section('js')
    @parent
    <script>
        $(function(){
            $('#{{$id}}').summernote({
                placeholder: '{{$placeholder}}',
                height: {{$height}},
                dialogsInBody: true,
                dialogsFade: false,
                fontNames: {!!$fontarray!!}
            });
            @if(!is_null($body))
            $('#{{$id}}').summernote('code',`{!!$body!!}`);
            @endif
        })
    </script>
@endsection
