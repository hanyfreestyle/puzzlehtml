@extends('admin.layouts.app')

@section('content')
    <x-breadcrumb-def :pageData="$pageData"/>
    <x-ui-card title="{{$pageData['AddPageName']}}">
        <form action="{{route('amenity.store')}}" method="post">
            @csrf

            <div class="col-lg-12">
                <div class="row">
                    @foreach ( config('app.lang_file') as $key=>$lang )
                        <div class="col-lg-6">
                            <x-trans-input
                                label="{{__('general.form.name_'.$key)}} ({{ $key}})"
                                name="{{ $key }}[name]"
                                dir="{{ $key }}"
                                reqname="{{ $key }}.name"
                                value="{{old($key.'.name')}}"
                            />
                        </div>
                    @endforeach
                </div>
            </div>

            <x-form-input label="Icon" name="icon" :requiredSpan="false" colrow="col-lg-4"
                          value="{{old('icon')}}" inputclass="dir_en"/>



            <div class="container-fluid">
                <x-form-submit text="{{$pageData['ViewType']}}" />
            </div>
        </form>

    </x-ui-card>
@endsection
