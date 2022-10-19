@extends('layouts.app')



@section('navigation')
    <x-nav current=""/>
@endsection

@section('content')
    <div class="max-w-7xl space-y-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">Subscription</h1>
        </div>




        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">

            <div class="py-4 space-y-8">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        You are currently on our <span class="font-bold">Starter</span> plan
                    </h3>
                    <dl class="mt-5 grid grid-cols-2 gap-4">

                        <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Forms Allowed
                            </dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                3
                            </dd>
                        </div>

                        <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Total Responses Allowed
                            </dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                1000
                            </dd>
                        </div>
                    </dl>
                </div>


                <div class="flex items-center justify-end space-x-4">
                    <a href="/pricing"
                       class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded text-gray-700 bg-white hover:bg-gray-50">
                        Change Plan
                    </a>

                    <form action="#" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit"
                                onclick="return confirm('This will set account inactive permanently, are you sure?')"
                                class="inline-flex items-center px-6 py-3  text-base font-medium rounded
                                                        bg-gray-200 hover:bg-gray-300 w-full text-red-400">
                            Cancel
                        </button>
                    </form>
                </div>
            </div>

        </div>


    </div>
@endsection
