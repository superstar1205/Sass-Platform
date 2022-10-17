@extends('layouts.install')




@section('content')
    <div class="max-w-5xl mx-auto px-4">
        <x-install.nav :completed="$completed" current="database"/>
        <div class="w-full border border-gray-300 border-t-0 rounded-b-lg">
            <div class="flex align-center justify-center">
                <div class="p-4 max-w-3xl space-y-10 w-full lg:w-1/2">

                    <div class="text-gray-800 text-lg">
                        <p>Fill in database credentials below:</p>
                    </div>

                    @if(Session::has('message'))
                        <div class="text-red-600 py-2 text-normal">
                            {{session('message')}}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('install.databases.store') }}">
                        @csrf
                        <div class="space-y-10">
                            <div
                                class="relative border border-gray-300 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-green-600 focus-within:border-green-600">
                                <label for="host"
                                       class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white text-xs font-medium text-gray-900">Host</label>
                                <input type="text"
                                       name="host"
                                       class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm"
                                       value="127.0.0.1"
                                       placeholder="127.0.0.1">
                            </div>

                            <div
                                class="relative border border-gray-300 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-green-600 focus-within:border-green-600">
                                <label for="port"
                                       class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white text-xs font-medium text-gray-900">Port</label>
                                <input type="text"
                                       name="port"
                                       class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm"
                                       value="3306"
                                       placeholder="3306">
                            </div>

                            <div
                                class="relative border border-gray-300 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-green-600 focus-within:border-green-600">
                                <label for="database"
                                       class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white text-xs font-medium text-gray-900">Database
                                    Name</label>
                                <input type="text"
                                       name="database"
                                       class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm"
                                       placeholder="database name">
                            </div>

                            <div
                                class="relative border border-gray-300 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-green-600 focus-within:border-green-600">
                                <label for="username"
                                       class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white text-xs font-medium text-gray-900">Username</label>
                                <input type="text"
                                       name="username"
                                       class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm"
                                       placeholder="user">
                            </div>


                            <div
                                class="relative border border-gray-300 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-green-600 focus-within:border-green-600">
                                <label for="password"
                                       class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white text-xs font-medium text-gray-900">Password</label>
                                <input type="password"
                                       name="password"
                                       class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm"
                                       placeholder="password">
                            </div>

                            <button type="submit"
                                    class="inline-flex items-center px-6 py-1 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:ring-0">
                                Proceed
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
