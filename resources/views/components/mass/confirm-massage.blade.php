@if(Session::has('Add.Done'))
    <div class="col-lg-12">
        <div class="alert alert-success alert-dismissible">
            {{__('admin/alertMass.confirmAdd')}}
        </div>
    </div>
@elseif(Session::has('Update.Done'))
    <div class="col-lg-12">
        <div class="alert alert-success alert-dismissible">
            {{__('admin/alertMass.confirmUpdate')}}
        </div>
    </div>
@elseif(Session::has('Edit.Done'))
    <div class="col-lg-12">
        <div class="alert alert-success alert-dismissible">
            {{__('admin/alertMass.confirmEdit')}}
        </div>
    </div>
@elseif(Session::has('restore'))
    <div class="col-lg-12">
        <div class="alert alert-success alert-dismissible">
            {{__('admin/alertMass.confirmRestore')}}
        </div>
    </div>


@elseif(Session::has('confirmDelete'))
    <div class="col-lg-12">
        <div class="alert alert-danger alert-dismissible">
            {{__('admin/alertMass.confirmDelete')}}
        </div>
    </div>
@endif



