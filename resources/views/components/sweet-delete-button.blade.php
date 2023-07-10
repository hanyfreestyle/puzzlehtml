<form id="thisForId_{{$row->id}}" method="post"  action="{{ route($routeName,$row->id) }}">
    @csrf
    @method('Delete')
    <button
        id="{{$row->id}}"
        @if($sweetOff == true)
        type="submit"
        @else
        type="button"
        @endif()
        class="btn btn-sm btn-danger @if($sweetOff == false) sweet_daleteBtn_class @endif()" ><i class="fas fa-trash"></i> {{__('admin/form.button_delete')}}</button>
</form>
