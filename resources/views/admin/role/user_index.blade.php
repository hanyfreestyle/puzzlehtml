@extends('admin.layouts.app')

@section('content')
    <x-breadcrumb-def :pageData="$pageData"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12" >

                <x-ui-card :page-data="$pageData">

                    <x-mass.confirm-massage />

                    @if(count($rowData)>0)
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{__('admin/config/roles.users_fr_name')}}</th>
                                    <th>{{__('admin/config/roles.users_fr_email')}}</th>
                                    <th>{{__('admin/config/roles.users_fr_phone')}}</th>
                                    <th>{{ __('admin/config/roles.users_fr_status') }}</th>
                                    <th>{{ __('admin/config/roles.users_fr_role') }}</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>

                                </tr>
                                </thead>
                                <tbody>

                                @foreach($rowData as $row)

                                    <tr>
                                        <td >{{$row->id}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->email}}</td>
                                        <td>{{$row->phone}}</td>
                                        <td> <input type="checkbox" class="status_but" thisid="{{$row->id}}" name="status" @if($row->status == '1') checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="success"></td>
                                        <td></td>

                                        <td>{!! \App\Helpers\AdminHelper::printTableImage($row,'photo') !!} </td>

                                        <td class="text-center">
                                            @can("users_edit")
                                            <x-action-button url="{{route('users.users.edit',$row->id)}}" type="edit" />
                                            @endcan

                                        </td >
                                        <td class="text-center">
                                            @can("users_delete")
                                            <x-action-button url="#" id="{{route('users.users.destroy',$row->id)}}" type="deleteSweet"  />
                                            @endcan
                                        </td>
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
        {{ $rowData->links() }}
    </div>
@endsection

@push('JsCode')
    <x-sweet-delete-js-no-form />
    <script>
        //alert(inputId);
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
