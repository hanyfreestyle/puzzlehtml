@extends('admin.layouts.app')

@section('content')
    <x-breadcrumb-def :pageData="$pageData"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12" >
                <x-ui-card :page-data="$pageData" >
                    <x-mass.confirm-massage />

                    @if(count($permissions)>0)
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{__('admin/config/roles.permission_frname')}}</th>
                                    <th>{{__('admin/config/roles.model_name')}}</th>
                                    <th>{{__('admin/def.form_name_ar')}}</th>
                                    <th>{{__('admin/def.form_name_en')}}</th>
                                    @can('permissions_edit')
                                        <th></th>
                                    @endcan
                                    @can('permissions_delete')
                                        <th></th>
                                    @endcan

                                </tr>
                                </thead>
                                <tbody>

                                @foreach($permissions as $permission)

                                    <tr>
                                        <td >{{$permission->id}}</td>
                                        <td>{{$permission->name}}</td>
                                        <td >{{ $modelsNameArr[$permission->cat_id]['name'] }}</td>
                                        <td>{{$permission->name_ar}}</td>
                                        <td>{{$permission->name_en}}</td>

                                        @can('permissions_edit')
                                            <td class="text-center">
                                                <x-action-button url="{{route('users.permissions.edit',$permission->id)}}" type="edit" />
                                            </td >
                                        @endcan
                                        @can('permissions_delete')
                                            <td class="text-center">
                                                <x-action-button url="#" id="{{route('users.permissions.destroy',$permission->id)}}" type="deleteSweet"  />
                                            </td>
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
        {{ $permissions->links() }}
    </div>
@endsection

@push('JsCode')
    <x-sweet-delete-js-no-form />
@endpush
