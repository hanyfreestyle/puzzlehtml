@extends('admin.layouts.app')

@section('content')
    <x-breadcrumb-def :pageData="$pageData"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12" >
                <x-ui-card :page-data="$pageData" >
                    <x-mass.confirm-massage />

                    @if(count($rowData)>0)
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{__('admin/def.form_name_ar')}}</th>


                                    <th></th>
                                    <th></th>

                                </tr>
                                </thead>
                                <tbody>

                                @foreach($rowData as $role)

                                    <tr>
                                        <td >{{$role->id}}</td>
                                        <td>{{$role->name_ar}}</td>


                                        <td class="text-center">
                                            <x-action-button url="{{route('users.roles.editRoleToPermission',$role->id)}}"   icon="fas fa-user-shield" print-lable="تعديل الصلاحيات" bg="p"  />
                                        </td >

                                        <td class="text-center">
                                            <x-action-button url="{{route('users.roles.edit',$role->id)}}" type="edit" />
                                        </td >



                                        <td class="text-center">
                                            <x-action-button url="#" id="{{route('users.roles.destroy',$role->id)}}" type="deleteSweet"  />
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
@endpush
