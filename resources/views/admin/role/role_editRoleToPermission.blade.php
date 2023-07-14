@extends('admin.layouts.app')

@section('content')

    <x-breadcrumb-def :pageData="$pageData"/>

    <x-ui-card :page-data="$pageData" >
        <x-mass.confirm-massage />
        <h1> {{$role->name}}</h1>
        <hr>




        <h1>Role Permission</h1>
        <div class="row">
            @foreach($permissions as $permission)
                @if( !$role->hasPermissionTo($permission) )

                    <div class="col-lg-3">
                        <label for="">{{$permission->name_ar}}</label>
                    <div class="form-group">
                    <input type="checkbox" class="status_but"
                           role_id="{{$role->id}}" permissionName="{{$permission->name}}" name="status"
                           data-bootstrap-switch data-off-color="danger" data-on-color="success">
                    </div>
                    </div>

                @else
                    <div class="col-lg-3">
                        <label for="">{{$permission->name_ar}}</label>
                        <div class="form-group">
                            <input type="checkbox" checked class="status_but"
                                   role_id="{{$role->id}}" permissionName="{{$permission->name}}" name="status"
                                   data-bootstrap-switch data-off-color="danger" data-on-color="success">
                        </div>
                    </div>

                @endif
            @endforeach

        </div>



    </x-ui-card>
@endsection


@push('JsCode')
    <script>
        $(".status_but").bootstrapSwitch({
            'size': 'mini',
            'onSwitchChange': function(event, state){
                var role_id = $(this).attr('role_id');
                var permissionName = $(this).attr('permissionName');
                 //alert(inputId);


                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: '{{ route('users.roles.givePermission9999') }}',
                    type: 'POST',
                    dataType: 'text',
                    data: {
                        role_id: role_id,
                        permissionName: permissionName,
                    },
                    success: function (response) {
                        console.log(response);
                    }
                });
            },
        });
    </script>
@endpush



