<div class="{{$colrow}}">
    <div class="form-group row">
        <label class="col-lg-6 font-weight-light ">{{$label}}</label>
        <div class="col-lg-6 pl-2 pr-2">

            <input type="checkbox" name="{{$name}}" @if($value == '1' or $value == 'on') checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">

        </div>
    </div>
</div>
