
<a href="{{$url}}"
   @if($id)
   id="{{$id}}"
   @endif
   @if($tip)
   data-toggle="tooltip" data-placement="top" title="{{$lable}}"
   @endif
   class="btn {{$size}} btn-{{$bg}} {{$sweetDelClass}}">
    @if($icon)
        <i class="fa {{$icon}}"></i> @if(!$tip) @endif
    @endif
    @if(!$tip)
        {{$lable}}
    @endif
</a>

