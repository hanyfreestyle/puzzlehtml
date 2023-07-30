<div class="row">

    <div class="col-lg-12">
        <div class="alert alert-dark alert-dismissible">
            {{$lable}}
        </div>
    </div>

    @foreach($Amenities as $Amenity)
        <div class="col-lg-2">
            <div class="form-group clearfix">
                <div class="icheck-primary d-inline">
                    <input name="amenity[]" id="{{$Amenity->id}}" class="icheck-primaryX d-inline" value="{{$Amenity->id}}"
                           type="checkbox"  {{ in_array($Amenity->id,old('amenity',$sendData)) ? 'checked' : '' }} >
                    <label for="{{ $Amenity->id }}"></label>
                    <span class="font-weight-bold">{{ $Amenity->name }}</span>
                </div>
            </div>
        </div>
    @endforeach

    @error('amenity')
    <div class="col-lg-12">
        <strong class="error_mass">{{ \App\Helpers\AdminHelper::error($message,'amenity',$lable) }}</strong>
    </div>
    @enderror

</div>
<hr>
