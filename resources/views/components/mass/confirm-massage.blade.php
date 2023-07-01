@if(Session::has('Add.Done'))
    <div class="col-lg-12">
        <div class="alert alert-success alert-dismissible">
            {!! Session::get('Add.Done') !!}
        </div>
    </div>

@elseif(Session::has('Edit.Done'))
    <div class="col-lg-12">
        <div class="alert alert-success alert-dismissible">
            {!! Session::get('Edit.Done') !!}
        </div>
    </div>
@elseif(Session::has('confirmDelete'))
    <div class="col-lg-12">
        <div class="alert alert-success alert-dismissible">
            {!! Session::get('confirmDelete') !!}
        </div>
    </div>
@endif






