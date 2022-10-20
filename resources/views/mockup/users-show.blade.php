@extends('layouts.app')



@section('navigation')
    <x-nav current=""/>
@endsection

@section('content')
    <div class="max-w-7xl space-y-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">View User</h1>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="py-8 space-y-2 ">

                <div class="bg-white p-4 bg-white shadow sm:rounded-lg">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">User</h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">test@gmail.com</p>
                    </div>
                    <div class="mt-5 border-t border-gray-200">
                        <dl class="sm:divide-y sm:divide-gray-200">


                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">

                                <dt class="text-normal sm:text-sm font-medium text-gray-500 mt-4 sm:mt-0">
                                    Package attached
                                </dt>
                                <dd class="text-normal sm:text-sm text-gray-900 mt-1 sm:mt-0 sm:col-span-2">
                                    Starter($10/month)
                                </dd>

                                <dt class="text-normal sm:text-sm font-medium text-gray-500 mt-4 sm:mt-0">
                                    Next payment
                                </dt>
                                <dd class="text-normal sm:text-sm text-gray-900 mt-1 sm:mt-0 sm:col-span-2">
                                    02 Jan 2022
                                </dd>

                                <dt class="text-normal sm:text-sm font-medium text-gray-500 mt-4 sm:mt-0">
                                    Number of forms allowed
                                </dt>
                                <dd class="text-normal sm:text-sm text-gray-900 mt-1 sm:mt-0 sm:col-span-2">
                                    2
                                </dd>

                                <dt class="text-normal sm:text-sm font-medium text-gray-500 mt-4 sm:mt-0">
                                    Number of responses allowed
                                </dt>
                                <dd class="text-normal sm:text-sm text-gray-900 mt-1 sm:mt-0 sm:col-span-2">
                                    2000
                                </dd>
                            </div>

                            <div class="pt-5">
                                <div class="flex justify-end">
                                    <div class="flex space-x-4 items-center justify-center" >
                                        <div>
                                            <a href="#"
                                               class="text-normal sm:text-xs font-medium hover:text-gray-700">
                                                Back
                                            </a>
                                        </div>
                                        <form action="#" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                    onclick="return confirm('This will set account inactive permanently, are you sure?')"
                                                    class="inline-flex items-center px-6 py-3  text-base font-medium rounded
                                                        bg-gray-200 hover:bg-gray-300 w-full text-red-400">
                                                Deactivate
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </dl>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="module" src="{{ asset('js/app.js') }}"></script>
@endpush
