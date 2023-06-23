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
        <select class="form-control {{$inputclass}} @error($name) is-invalid @enderror"
                id="{{$id}}" name="{{$name}}" style="width:100%"
            {{($required) ? 'required' : '' }}
            {{($disabled) ? 'disabled' : '' }}
            {{($multiple) ? 'multiple' : '' }}>
            {{$slot}}
        </select>
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
        $(()=>{ $('#{{$id}}').select2({ theme: 'bootstrap4' }); })
    </script>
@endsection
