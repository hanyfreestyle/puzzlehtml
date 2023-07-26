@if( $count == '0')
    <a href="{{$url}}" class="btn bg-dark btn-app"><i class="{{ $icon }}"></i> {{ $name }}</a>
@else
    <a href="{{$url}}" class="btn btn-app bg-primary">
        <span class="badge bg-dark"><strong>{{ $count }}</strong> </span>
        <i class="{{ $icon }}"></i> {{ $name }}
    </a>
@endif
