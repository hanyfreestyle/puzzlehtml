
<a href="{{$url}}"
   @if($tip)
   data-toggle="tooltip" data-placement="top" title="{{$lable}}"
   @endif

   class="btn {{$size}} btn-{{$bg}}">
    @if($icon)
        <i class="fa {{$icon}}"></i>
    @endif
    @if(!$tip)
    {{$lable}}
    @endif

</a>
