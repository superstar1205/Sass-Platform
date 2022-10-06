@extends('layouts.app')



@section('navigation')
    <x-nav current="subscriptions"/>
@endsection

@section('content')
    <div class="max-w-7xl space-y-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">Subscription</h1>
        </div>




        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">

            <div class="py-4 space-y-8">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')"/>

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                @if(! $subscription)
                    <div class="border-4 border-dashed border-gray-200 rounded-lg h-96 flex items-center justify-center flex-col">
                        <p class="text-lg font-mono text-gray-500">You have not created any subscription yet.</p>
                        <p class="text-lg font-mono block text-gray-500">
                            <a href="{{ route('pricing') }}" class="text-gray-900">
                                Create </a> your first subscription now!
                        </p>
                    </div>
                @elseif($subscription)
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        You are currently on our <span class="font-bold">{{ optional($subscription->package)->title }}</span> plan
                    </h3>
                    <dl class="mt-5 grid grid-cols-2 gap-4">

                        <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Forms Allowed
                            </dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                {{ optional($subscription->package)->forms_number }}
                            </dd>
                        </div>

                        <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Total Responses Allowed
                            </dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                {{ optional($subscription->package)->responses_number }}
                            </dd>
                        </div>
                    </dl>
                </div>


                <div class="flex items-center justify-end space-x-4">
                    <a href="/pricing"
                       class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded text-gray-700 bg-white hover:bg-gray-50">
                        Change Plan
                    </a>
                    @if($subscription->active() && !$subscription->onGracePeriod())
                        <form action="{{ route('admin.subscriptions.destroy', 'default') }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit"
                                    onclick="return confirm('This will set account inactive permanently, are you sure?')"
                                    class="inline-flex items-center px-6 py-3  text-base font-medium rounded
                                                            bg-gray-200 hover:bg-gray-300 w-full text-red-400">
                                Cancel
                            </button>
                        </form>
                    @elseif($subscription->onGracePeriod())
                        <form action="{{ route('admin.subscriptions.resume', 'default') }}" method="POST">
                            @csrf
                            <button type="submit"
                                    onclick="return confirm('This will set account inactive permanently, are you sure?')"
                                    class="inline-flex items-center px-6 py-3  text-base font-medium rounded
                                                            bg-gray-200 hover:bg-gray-300 w-full text-red-400">
                                Resume
                            </button>
                        </form>
                    @endif
                </div>
                @endif
            </div>

        </div>


    </div>
@endsection
