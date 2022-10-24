<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('app.name', 'Formed')}}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<style>
    .StripeElement {
        background-color: white;
        padding: 8px 12px;
        border-radius: 4px;
        border: 1px solid transparent;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>

<body class="h-full">

<div class="max-w-5xl mx-auto mt-10 space-y-4">

    <div class="w-full mx-auto px-4 flex items-center justify-center flex-col">
        <h1 class="font-semibold text-gray-900 text-5xl">{{ __('Payment') }}</h1>

        <p class="w-full sm:w-1/2 py-4 text-gray-700 text-sm text-center">
           {{ __('Your payment will be processed by Stripe. The payment infrastructure powers millions of businesses of all sizes.') }}
        </p>

        <p class="w-full sm:w-1/2 flex items-center justify-center">
            <img class=" h-12" src="{{ url('/img/stripe-logo.png') }}">
        </p>

        @csrf
        <div class="w-full sm:w-1/2  space-y-8 sm:space-y-5">
            <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
                <!-- Stripe Elements Placeholder -->
                <div id="card-element"
                     class="block w-full px-4 py-3 pr-8 md:pr-4 rounded text-gray-900 border-gray-200 focus:border-gray-200 focus:ring-2 focus:ring-gray-100"></div>
            </div>

            <div class="pb-4">
                <div class="flex justify-end">
                    <button type="submit" id="card-button" data-secret="{{ $intent->client_secret }}"
                            style="background-color:#212129;color: #FFFFFF"
                            class="rounded focus:ring-2 focus:ring-blue-300 focus:outline-none block w-full text-center font-semibold tracking-tight rounded py-4 transition-colors duration-100 ease-out remove-outline focus:outline-none"
                    >{{ __('Pay') }}
                    </button>
                </div>
            </div>
        </div>


    </div>


</div>


<script src="https://js.stripe.com/v3/"></script>
<script src="{{ asset('js/app.js') }}" defer></script>

<script>
    const stripe = Stripe("{{ config('cashier.key') }}");
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;
    cardButton.addEventListener('click', async (e) => {
        cardButton.disabled = true;
        cardButton.innerHTML = "Processing";
        const {setupIntent, error} = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: cardElement,
                }
            }
        );
        if (error) {
            // Display "error.message" to the user...
            console.log(error);
            alert(error.message);
            window.location.reload();
        } else {
            axios.post("{{ route('subscriptions.store', $package_id) }}", {payment_method: setupIntent.payment_method}).then(response => {
                window.location.href = "{{ route('subscriptions.success') }}"
            }).catch(function (error) {
                alert(error?.response?.data?.message);
                window.location.reload();
            })
        }
    });
</script>
</body>
</html>

