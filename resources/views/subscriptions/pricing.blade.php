<x-guest-layout>


    <div class="max-w-5xl mx-auto mt-10 space-y-4">

        <div class="w-full mx-auto px-4 flex items-center justify-center flex-col">
            <h1 class="font-semibold text-gray-900 text-5xl">{{ __('Pricing') }}</h1>
            <p class="text-lg py-4">
                {{ __("We've got a plan for any size") }}
            </p>
        </div>

        @if($packages->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 px-2">

            @foreach($packages as $package)
                <div
                class="rounded-md border border-gray-300 px-4 py-10 flex items-center justify-center flex-col space-y-6">

                <div>
                    <h2 class="text-4xl font-bold">{{ $package->title }}</h2>
                </div>
                <div>
                    <p class="text-4xl font-bold">{{ $package->price_money->toString() }}/<span class="text-base">{{ __('month') }}</span></p>
                </div>

                <div>
                    <ul class="flex flex-col space-y-2">
                        <li class="inline-flex">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>

                            {{ $package->forms_number }} {{ __('forms') }}
                        </li>

                        <li class="inline-flex">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ $package->responses_number }} {{ __('responses') }}
                        </li>
                    </ul>

                </div>

                <div class="w-full">
                    @if(auth()->check() && auth()->user()->subscribedToPrice($package->price_id))
                        <a href="#" class="py-4 w-full flex items-center justify-center border bg-gray-50" disabled>
                            {{ __('Already Subscribed') }}
                        </a>
                    @else
                        <a href="{{ route('subscriptions.create', $package->id) }}" class="py-4 w-full flex items-center justify-center border hover:bg-gray-50 rounded-md">
                            {{ __('Subscribe') }}
                        </a>
                    @endif
                </div>
            </div>
            @endforeach

        </div>
        @endif

    </div>
</x-guest-layout>



