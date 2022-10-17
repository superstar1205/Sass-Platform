@extends('layouts.install')




@section('content')
    <div class="max-w-5xl mx-auto px-4">
        <x-install.nav :completed="$completed" current="user"/>
        <div class="w-full border border-gray-300 border-t-0 rounded-b-lg">
            <div class="flex align-center justify-center">
                <div class="p-4 max-w-2xl space-y-2">

                    <div class="text-gray-800 text-lg space-y-2">
                        <p>
                            In this step, we will create the default admin account.
                            Note down the username and password below, you will need them when logging into the
                            admin panel.
                        </p>

                        <ul class="">
                            <li>Username: <span class="font-mono font-bold">admin@formed.com</span></li>
                            <li>Password: <span class="font-mono font-bold">password</span></li>
                        </ul>

                        <p>Do remember to update the password from the admin panel later.</p>

                        <p class="mt-10">Click the button below to proceed.</p>
                    </div>

                    @if(Session::has('message'))
                        <div class="text-red-600 py-2 text-normal">
                            {{session('message')}}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('install.users.store') }}">
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
