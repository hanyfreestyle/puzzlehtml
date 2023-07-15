@extends('admin.layouts.app')

@section('content')
    <x-breadcrumb-def :pageData="$pageData"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12" >

                <x-ui-card :page-data="$pageData">

                    <x-mass.confirm-massage />

                    @if(count($users)>0)
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{__('admin/config/roles.users_fr_name')}}</th>
                                    <th>{{__('admin/config/roles.users_fr_email')}}</th>
                                    <th>{{ __('admin/config/roles.users_fr_status') }}</th>
                                    <th>{{ __('admin/config/roles.users_fr_role') }}</th>
                                    <th></th>
                                    @can("users_add")<th></th>@endcan
                                    @can("users_edit")<th></th>@endcan
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        @can("users_edit")
                                            <td> <input type="checkbox" class="status_but" thisid="{{$user->id}}" name="status" @if($user->status == '1') checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="success"></td>
                                        @else
                                            <td class="text-center">{!! printStateIcon($user->status) !!}</td>
                                        @endcan

                                        <td>
                                            @foreach($roles as $role)
                                                @if($user->hasRole($role->name))
                                                    <x-action-button print-lable="{{$role->name_ar}}"/>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{!! \App\Helpers\AdminHelper::printTableImage($user,'photo') !!} </td>

                                        @can("users_edit")
                                            <td class="text-center"><x-action-button url="{{route('users.users.edit',$user->id)}}" type="edit" /></td>
                                        @endcan

                                        @can("users_delete")
                                            <td class="text-center"><x-action-button url="#" id="{{route('users.users.destroy',$user->id)}}" type="deleteSweet"  /></td>
                                        @endcan

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <x-alert-massage type="nodata" />
                    @endif
                </x-ui-card>

            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $users->links() }}
    </div>
@endsection

@push('JsCode')
    <x-sweet-delete-js-no-form />
    <script>
        $(".status_but").bootstrapSwitch({
            'size': 'mini',
            'onSwitchChange': function(event, state){
                var inputId = $(this).attr('thisid');

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: '{{ route('users.users.updateStatus') }}',
                    type: 'POST',
                    dataType: 'text',
                    data: {
                        send_id: inputId,
                    },
                    success: function (response) {
                        console.log(response);
                    }
                });
            },
        });
    </script>
@endpush
