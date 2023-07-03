<div class="{{$colrow}}">
    <div class="form-group">
        <label class="def_form_label col-form-label font-weight-light">
            {{$label}}
            @if($requiredSpan)
                <span class="required_Span">*</span>
            @endif
        </label>

        <select class="form-control select2 custom-select is-invalid " id="{{$name}}" name="{{$name}}" style="width: 100%;" >
            <option value="">{{$label}}</option>

            @if($selectType == 'normal')
                @foreach ($sendArr as  $key => $value)
                    <option value="{{ $value['id'] }}" @if ($value['id'] == $sendvalue) selected @endif>{{ $value['name'] }}</option>
                @endforeach
            @elseif($selectType == 'file')
                @foreach($sendArr as $file)
                    <option value="{{$file}}" @if ($file == $sendvalue) selected @endif>{{pathinfo($file, PATHINFO_BASENAME)}}</option>
                @endforeach
            @endif



        </select>
        @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ \App\Helpers\AdminHelper::error($message,$name,$label) }}</strong>
        </span>
        @enderror
    </div>

</div>
