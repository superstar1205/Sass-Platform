@extends('layouts.app')



@section('navigation')
    <x-nav current="envs"/>
@endsection

@section('content')
    <div class="max-w-7xl space-y-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">{{ __('Settings') }}</h1>
        </div>

        <form
            id="createEnvs"
            action="{{ route('admin.envs.store') }}"
            method="post">
            @csrf
            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                <div class="py-8 space-y-2">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">


                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">


                                <x-auth-session-status class="mb-4" :status="session('status')"/>

                                <x-auth-validation-errors class="mb-4" :errors="$errors"/>

                                @if(config('app.demo'))
                                    <x-auth-info class="mb-4" status="Modification is disabled in demo site"/>
                                @endif


                                <div class="space-y-4">

                                    <div
                                        class="py-5 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg  px-5 px-2 bg-white">
                                        <div class="space-y-8 divide-y divide-gray-200">
                                            <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                                                <div>
                                                    <div>
                                                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                            {{ __('Site Settings') }}
                                                        </h3>
                                                    </div>
                                                    <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">


                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                            <label for="app_name"
                                                                   class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                                APP_NAME
                                                            </label>
                                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                                <input id="app_name"
                                                                       name="app_name"
                                                                       value="{{ env('APP_NAME') }}"
                                                                       required
                                                                       type="text"
                                                                       autocomplete="app_name"
                                                                       class="block max-w-lg w-full px-4 py-3 pr-8 md:pr-4 rounded text-gray-900 border border-gray-200 focus:border-gray-200 focus:ring-2 focus:ring-gray-100">
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                            <label for="app_url"
                                                                   class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                                APP_URL
                                                            </label>
                                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                                <input id="app_url"
                                                                       name="app_url"
                                                                       value="{{ env('APP_URL') }}"
                                                                       required
                                                                       type="text"
                                                                       autocomplete="app_url"
                                                                       class="block max-w-lg w-full px-4 py-3 pr-8 md:pr-4 rounded text-gray-900 border border-gray-200 focus:border-gray-200 focus:ring-2 focus:ring-gray-100">
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="py-5 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg  px-5 px-2 bg-white">

                                        <div class="space-y-8 divide-y divide-gray-200">
                                            <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                                                <div>
                                                    <div>
                                                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                            {{ __('Database Settings') }}
                                                        </h3>
                                                    </div>
                                                    <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                            <label for="db_connection"
                                                                   class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                                DB_CONNECTION
                                                            </label>
                                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                                <input id="db_connection"
                                                                       name="db_connection"
                                                                       value="{{ env('DB_CONNECTION') }}"
                                                                       required
                                                                       type="text"
                                                                       autocomplete="db_connection"
                                                                       class="block max-w-lg w-full px-4 py-3 pr-8 md:pr-4 rounded text-gray-900 border border-gray-200 focus:border-gray-200 focus:ring-2 focus:ring-gray-100">
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                            <label for="db_host"
                                                                   class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                                DB_HOST
                                                            </label>
                                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                                <input id="db_host"
                                                                       name="db_host"
                                                                       value="{{ env('DB_HOST') }}"
                                                                       required
                                                                       type="text"
                                                                       autocomplete="db_host"
                                                                       class="block max-w-lg w-full px-4 py-3 pr-8 md:pr-4 rounded text-gray-900 border border-gray-200 focus:border-gray-200 focus:ring-2 focus:ring-gray-100">
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                            <label for="db_port"
                                                                   class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                                DB_PORT
                                                            </label>
                                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                                <input id="db_port"
                                                                       name="db_port"
                                                                       value="{{ env('DB_PORT') }}"
                                                                       required
                                                                       type="text"
                                                                       autocomplete="db_port"
                                                                       class="block max-w-lg w-full px-4 py-3 pr-8 md:pr-4 rounded text-gray-900 border border-gray-200 focus:border-gray-200 focus:ring-2 focus:ring-gray-100">
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                            <label for="db_database"
                                                                   class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                                DB_DATABASE
                                                            </label>
                                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                                <input id="db_database"
                                                                       name="db_database"
                                                                       value="{{ env('DB_DATABASE') }}"
                                                                       required
                                                                       type="text"
                                                                       autocomplete="db_database"
                                                                       class="block max-w-lg w-full px-4 py-3 pr-8 md:pr-4 rounded text-gray-900 border border-gray-200 focus:border-gray-200 focus:ring-2 focus:ring-gray-100">
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                            <label for="db_username"
                                                                   class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                                DB_USERNAME
                                                            </label>
                                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                                <input id="db_username"
                                                                       name="db_username"
                                                                       value="{{ env('DB_USERNAME') }}"
                                                                       required
                                                                       type="text"
                                                                       autocomplete="db_username"
                                                                       class="block max-w-lg w-full px-4 py-3 pr-8 md:pr-4 rounded text-gray-900 border border-gray-200 focus:border-gray-200 focus:ring-2 focus:ring-gray-100">
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                            <label for="db_password"
                                                                   class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                                DB_PASSWORD
                                                            </label>
                                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                                <input id="db_password"
                                                                       name="db_password"
                                                                       value="{{ env('DB_PASSWORD') }}"
                                                                       required
                                                                       type="text"
                                                                       autocomplete="db_password"
                                                                       class="block max-w-lg w-full px-4 py-3 pr-8 md:pr-4 rounded text-gray-900 border border-gray-200 focus:border-gray-200 focus:ring-2 focus:ring-gray-100">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="py-5 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg  px-5 px-2 bg-white">

                                        <div class="space-y-8 divide-y divide-gray-200">
                                            <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                                                <div>
                                                    <div>
                                                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                            {{ __('Email Settings') }}
                                                        </h3>
                                                    </div>
                                                    <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                            <label for="mail_mailer"
                                                                   class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                                MAIL_MAILER
                                                            </label>
                                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                                <input id="mail_mailer"
                                                                       name="mail_mailer"
                                                                       value="{{ config('mail.default') }}"
                                                                       required
                                                                       type="text"
                                                                       autocomplete="mail_mailer"
                                                                       class="block max-w-lg w-full px-4 py-3 pr-8 md:pr-4 rounded text-gray-900 border border-gray-200 focus:border-gray-200 focus:ring-2 focus:ring-gray-100">
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                            <label for="mail_host"
                                                                   class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                                MAIL_HOST
                                                            </label>
                                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                                <input id="mail_host"
                                                                       name="mail_host"
                                                                       value="{{ env('MAIL_HOST') }}"
                                                                       required
                                                                       type="text"
                                                                       autocomplete="mail_host"
                                                                       class="block max-w-lg w-full px-4 py-3 pr-8 md:pr-4 rounded text-gray-900 border border-gray-200 focus:border-gray-200 focus:ring-2 focus:ring-gray-100">
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                            <label for="mail_port"
                                                                   class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                                MAIL_PORT
                                                            </label>
                                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                                <input id="mail_port"
                                                                       name="mail_port"
                                                                       value="{{ env('MAIL_PORT') }}"
                                                                       required
                                                                       type="text"
                                                                       autocomplete="mail_port"
                                                                       class="block max-w-lg w-full px-4 py-3 pr-8 md:pr-4 rounded text-gray-900 border border-gray-200 focus:border-gray-200 focus:ring-2 focus:ring-gray-100">
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                            <label for="mail_username"
                                                                   class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                                MAIL_USERNAME
                                                            </label>
                                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                                <input id="mail_username"
                                                                       name="mail_username"
                                                                       value="{{ env('MAIL_USERNAME') }}"
                                                                       required
                                                                       type="text"
                                                                       autocomplete="mail_username"
                                                                       class="block max-w-lg w-full px-4 py-3 pr-8 md:pr-4 rounded text-gray-900 border border-gray-200 focus:border-gray-200 focus:ring-2 focus:ring-gray-100">
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                            <label for="mail_password"
                                                                   class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                                MAIL_PASSWORD
                                                            </label>
                                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                                <input id="mail_password"
                                                                       name="mail_password"
                                                                       value="{{ env('MAIL_PASSWORD') }}"
                                                                       required
                                                                       type="text"
                                                                       autocomplete="mail_password"
                                                                       class="block max-w-lg w-full px-4 py-3 pr-8 md:pr-4 rounded text-gray-900 border border-gray-200 focus:border-gray-200 focus:ring-2 focus:ring-gray-100">
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                            <label for="mail_encryption"
                                                                   class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                                MAIL_ENCRYPTION
                                                            </label>
                                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                                <input id="mail_encryption"
                                                                       name="mail_encryption"
                                                                       value="{{ env('MAIL_ENCRYPTION') }}"
                                                                       required
                                                                       type="text"
                                                                       autocomplete="mail_encryption"
                                                                       class="block max-w-lg w-full px-4 py-3 pr-8 md:pr-4 rounded text-gray-900 border border-gray-200 focus:border-gray-200 focus:ring-2 focus:ring-gray-100">
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                            <label for="mail_from_address"
                                                                   class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                                MAIL_FROM_ADDRESS
                                                            </label>
                                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                                <input id="mail_from_address"
                                                                       name="mail_from_address"
                                                                       value="{{ env('MAIL_FROM_ADDRESS') }}"
                                                                       required
                                                                       type="text"
                                                                       autocomplete="mail_from_address"
                                                                       class="block max-w-lg w-full px-4 py-3 pr-8 md:pr-4 rounded text-gray-900 border border-gray-200 focus:border-gray-200 focus:ring-2 focus:ring-gray-100">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="py-5 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg  px-5 px-2 bg-white">

                                        <div class="space-y-8 divide-y divide-gray-200">
                                            <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                                                <div>
                                                    <div>
                                                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                            {{ __('Stripe Settings') }}
                                                        </h3>
                                                    </div>
                                                    <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                            <label for="stripe_key"
                                                                   class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                                STRIPE_KEY
                                                            </label>
                                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                                <input id="stripe_key"
                                                                       name="stripe_key"
                                                                       value="{{ config('cashier.key') }}"
                                                                       required
                                                                       type="text"
                                                                       autocomplete="stripe_key"
                                                                       class="block max-w-lg w-full px-4 py-3 pr-8 md:pr-4 rounded text-gray-900 border border-gray-200 focus:border-gray-200 focus:ring-2 focus:ring-gray-100">
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                            <label for="stripe_secret"
                                                                   class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                                STRIPE_SECRET
                                                            </label>
                                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                                <input id="stripe_secret"
                                                                       name="stripe_secret"
                                                                       value="{{ config('cashier.secret') }}"
                                                                       required
                                                                       type="text"
                                                                       autocomplete="stripe_secret"
                                                                       class="block max-w-lg w-full px-4 py-3 pr-8 md:pr-4 rounded text-gray-900 border border-gray-200 focus:border-gray-200 focus:ring-2 focus:ring-gray-100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    @if(!config('app.demo'))
                                        <div class="pt-5">
                                            <div class="flex justify-end" x-data="{loading:false}">
                                                <button type="submit"
                                                        @click="loading=true; document.getElementById('createEnvs').submit();"
                                                        x-bind:disabled="loading"
                                                        class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded text-gray-700 bg-white hover:bg-gray-50">
                                                    {{ __('Save') }}
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection

@push('script')
    <script type="module" src="{{ asset('js/app.js') }}"></script>
@endpush
