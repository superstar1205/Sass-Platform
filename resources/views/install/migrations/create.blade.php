@extends('layouts.install')




@section('content')
    <div class="max-w-5xl mx-auto px-4">
        <x-install.nav :completed="$completed" current="migration"/>
        <div class="w-full border border-gray-300 border-t-0 rounded-b-lg">
            <div class="flex align-center justify-center">
                <div class="p-4 max-w-2xl space-y-2">

                    <div class="text-gray-800 text-lg">
                        <p>In this step, we will create database tables required for the application.</p>
                        <p class="mt-10">Click the button below to proceed.</p>
                    </div>

                    @if(Session::has('message'))
                        <div class="text-red-600 py-2 text-normal">
                            {{session('message')}}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('install.migrations.store') }}">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center px-6 py-1 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:ring-0">
                            Proceed
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
