@extends('layouts.install')




@section('content')
    <div class="max-w-5xl mx-auto px-4">
        <x-install.nav :completed="$completed" current="done"/>
        <div class="w-full border border-gray-300 border-t-0 rounded-b-lg">
            <div class="flex align-center justify-center">
                <div class="p-4 max-w-2xl space-y-2">

                    <div class="text-gray-800 text-lg space-y-2">
                        <p class="text-green-600 text-2xl">Congratulations! </p>
                        <p>You can now login to the admin page below using the default admin account.
                        </p>

                        <p>
                            <a class="text-gray-500" href="{{ route('admin') }}">{{ route('admin') }}</a>
                        </p>
                    </div>


                </div>

            </div>
        </div>
    </div>
@endsection
