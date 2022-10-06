@extends('layouts.app')



@section('navigation')
    <x-nav current="invoices"/>
@endsection

@section('content')
    <div class="max-w-7xl space-y-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">Invoices</h1>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="py-8 space-y-2">

                @if($users->isNotEmpty())

                    <div class="flex items-center justify-between" x-data="{
                        open: false,
                        toggle() {
                            if (this.open) {
                                return this.close()
                            }

                            this.open = true
                        },
                        close(focusAfter) {
                            this.open = false

                            focusAfter && focusAfter.focus()
                        }
                    }"
                         x-on:keydown.escape.prevent.stop="close($refs.button)"
                         x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                         x-id="['dropdown-button']"
                    >

                        <div class="relative inline-block text-left">
                            <div>
                                <button
                                        x-ref="button"
                                        x-on:click="toggle()"
                                        :aria-controls="$id('dropdown-button')"
                                        class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50"
                                        id="menu-button" aria-expanded="true" aria-haspopup="true">
                                    Select a User
                                    <!-- Heroicon name: solid/chevron-down -->
                                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20"
                                         fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>

                            <div x-ref="panel"
                                 x-show="open"
                                 x-transition.origin.top.right
                                 x-on:click.outside="close($refs.button)"
                                 :id="$id('dropdown-button')"
                                 style="display: none;"
                                 class="origin-top-left absolute left-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                 role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                <div class="py-1" role="none">
                                @foreach($users as $key => $value)
                                    <!-- Active: "bg-gray-100 text-gray-500", Not Active: "text-gray-700" -->
                                    <a href="{{ route('admin.invoices.index', ['user_id' => $key]) }}"
                                       class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                                       id="menu-item-0">{{ $value }}</a>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                    @if(!$selectedUser)
                        <div
                                class="border-4 border-dashed border-gray-200 rounded-lg h-96 flex items-center justify-center flex-col">
                            <p class="text-lg font-mono text-gray-500 px-4">Select a user to view/export its invoices.</p>
                        </div>
                    @endif
                    @if($selectedUser)
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Payment date
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Amount paid
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Email address
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($selectedUser->invoices() as $invoice)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $invoice->date()->toFormattedDateString() }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $invoice->total() }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $invoice->customer_email }}
                                            </td>
                                            <td class="w-10 px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <div class="space-x-2">
                                                    <a target="_blank" href="{{ $invoice->hosted_invoice_url }}"
                                                       class="text-xs font-medium hover:text-gray-700">
                                                        View
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="module" src="{{ asset('js/app.js') }}"></script>
@endpush
