<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Formed') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="h-full">

<div class="mx-auto">


    @yield('navigation')

    <div class="md:pl-64 flex flex-col flex-1">

        <main class="flex-1">
            <div class="py-6">
                @yield('content')
            </div>
        </main>

    </div>

</div>

</body>
@stack('script')
</html>
