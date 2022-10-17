@extends('layouts.install')




@section('content')
    <div class="max-w-5xl mx-auto px-4">
        <x-install.nav :completed="$completed"/>
        <div class="w-full border border-gray-300 border-t-0 rounded-b-lg">
            <div class="flex align-center justify-center">
                <div class="p-4 max-w-2xl space-y-2">

                    <div class="text-gray-800 text-lg">
                        <p>In this step, we will create a <span class="font-mono text-gray-500">.env</span> file for your application.
                            A <span class="font-mono text-gray-500">.env</span> file is like a configuration file, which stores the configuration values for this application.</p>
                        <p>Click the button below to proceed.</p>
                    </div>

                    <button type="submit"
                            class="inline-flex items-center px-6 py-1 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:ring-0">
                        Proceed
                    </button>

                </div>

            </div>
        </div>
    </div>
@endsection
