<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Formed') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="h-full py-10">

<div class="w-full mx-auto flex justify-center py-6">
    <h1 class="text-5xl font-bold">Installation</h1>
</div>

@yield('content')

</body>
@stack('script')
</html>
