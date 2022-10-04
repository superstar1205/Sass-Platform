@extends('layouts.app-form')



@section('navigation')
    <x-nav current="forms"/>
@endsection

@section('content')
    <div id="root" class="font-sans antialiased authenticated"></div>
@endsection

@push('script')
    <script>
        var editform = {!! json_encode($form, true) !!}
    </script>
    <script type="module" src="{{ asset('js/formed-builder.js') }}"></script>
@endpush
