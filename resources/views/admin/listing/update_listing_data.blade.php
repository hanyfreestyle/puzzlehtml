@extends('admin.layouts.app')



@section('content')

@foreach($Developers as  $Developer)
    {{$Developer->id }}
    <br>


@endforeach

@endsection

@push('JsCode')

@endpush


