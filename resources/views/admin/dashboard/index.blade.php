@extends('layouts.app')



@section('navigation')
    <x-nav current="dashboard"/>
@endsection

@section('content')
    <div class="max-w-7xl space-y-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">{{ __('Dashboard') }}</h1>
        </div>

        @if(!$hasForm)
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="py-4">
                <div class="border-4 border-dashed border-gray-200 rounded-lg h-96 flex items-center justify-center flex-col">
                    <p class="text-lg font-mono block text-gray-500">Welcome to Formed, you have not yet created any form yet.</p>
                    <p class="text-lg font-mono block text-gray-500">
                        <a href="{{ route('admin.forms.create') }}" class="text-gray-900">
                            Start</a>
                        by creating your first form now!
                    </p>
                </div>
            </div>
        </div>
        @endif


        @if($hasForm)
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="py-4">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        {{ __('Stats') }}
                    </h3>
                    <dl class="mt-5 grid grid-cols-2 gap-4">

                        <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Total Forms Created
                            </dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                {{ $formsCreated }}
                            </dd>
                        </div>

                        <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Total Responses Collected
                            </dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                {{ $responsesCollected }}
                            </dd>
                        </div>
                    </dl>
                </div>

            </div>
        </div>
        @endif


    </div>
@endsection
