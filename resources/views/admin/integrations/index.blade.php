@extends('layouts.app')



@section('navigation')
    <x-nav current="integration"/>
@endsection

@section('content')
    <div class="max-w-7xl space-y-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">Integrations</h1>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="py-8 space-y-2">

                <div class="flex">
                    <ul role="list" class="w-full">
                        @foreach($integrations as $integration)
                        <li class="py-4">
                            <div class="bg-white shadow sm:rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900"
                                        id="renew-subscription-label">
                                        {{ __($integration->name) }}
                                    </h3>
                                    <div class="mt-2 sm:flex sm:items-start sm:justify-between">
                                        <div class="max-w-xl text-sm text-gray-500">
                                            <p id="renew-subscription-description">
                                                {{ __($integration->desc) }}
                                            </p>
                                        </div>
                                        <div class="mt-5 sm:mt-0 sm:ml-6 sm:flex-shrink-0 flex items-center space-x-4">
                                            <div>
                                                <a href="{{ route('admin.integrations.edit', $integration->id) }}" class="h-12 w-12 flex items-center justify-start group">
                                                    <span class="sr-only"></span>
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="h-8 w-8 text-gray-500 group-hover:text-gray-900"
                                                         viewBox="0 0 24 24" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                              d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                                              clip-rule="evenodd"/>
                                                    </svg>
                                                </a>
                                            </div>
                                            <div>
                                                <form method="POST" action="{{ route('admin.integration-status.update', $integration->id) }}">
                                                    @method('PUT')
                                                    @csrf
                                                    <x-dropdown-link :href="route('admin.integration-status.update', $integration->id)"
                                                                     onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                                        <button type="button"
                                                                class="@if($integration->status->equals(\App\Enums\Integrations\Status::disable())) bg-gray-200 @else bg-gray-600 @endif relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                                                                role="switch" aria-checked="false"
                                                                aria-labelledby="renew-subscription-label"
                                                                aria-describedby="renew-subscription-description">
                                                            <!-- Enabled: "translate-x-5", Not Enabled: "translate-x-0" -->
                                                            <span aria-hidden="true"
                                                                  class="@if($integration->status->equals(\App\Enums\Integrations\Status::disable())) translate-x-0 @else translate-x-5 @endif inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                                                        </button>
                                                    </x-dropdown-link>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>

                </div>

            </div>
        </div>
    </div>
@endsection
