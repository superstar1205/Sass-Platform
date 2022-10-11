<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="h-full">

<div class="mx-auto">
    <div class="min-h-full">
        <div class="py-2">
            <main>
                <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                    {!! $page->render() !!}
                </div>
            </main>
        </div>
    </div>
</div>
</body>
</html>
