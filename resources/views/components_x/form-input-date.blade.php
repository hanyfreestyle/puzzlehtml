<div class="form-group {{($horizontalLabel) ? 'row' : '' }} {{$topclass}}">

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
        <input type="text" class="{{$inputclass}} form-control datetimepicker-input @error($name) is-invalid @enderror"
               name="{{$name}}" id="{{$id}}"
               data-toggle="datetimepicker" data-target="#{{$id}}"
               placeholder="{{$placeholder}}" value="{{$value}}"
            {{($required) ? 'required' : '' }}
            {{($disabled) ? 'disabled' : '' }}/>

        @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ \App\Helpers\AdminHelper::error($message,$name,$label) }}</strong>
        </span>
        @enderror
    </div>


</div>

@section('js')
    @parent
    <script>
        $(()=>{
            $.fn.datetimepicker.Constructor.Default = $.extend({}, $.fn.datetimepicker.Constructor.Default, { icons: { time: 'fas fa-clock', date: 'fas fa-calendar', up: 'fas fa-arrow-up', down: 'fas fa-arrow-down', previous: 'fas fa-caret-left', next: 'fas fa-caret-right', today: 'far fa-calendar-check-o', clear: 'far fa-trash', close: 'far fa-times' } });
            $('#{{$id}}').datetimepicker({format: '{{$format}}'});
        })
    </script>
@endsection
