@extends('layouts.app')



@section('navigation')
    <x-nav current="responses"/>
@endsection

@section('content')
    <div class="max-w-7xl space-y-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">Responses @if(!empty($selectedForm))
                    (from {{ $selectedForm->title }}) @endif</h1>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="py-8 space-y-2">

                @if($hasForm)

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
                                    Select a form
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
                                @foreach($forms as $key => $value)
                                    <!-- Active: "bg-gray-100 text-gray-500", Not Active: "text-gray-700" -->
                                        <a href="{{ route('admin.responses.index', ['form_id' => $key]) }}"
                                           class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                                           id="menu-item-0">{{ $value }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        @if($selectedForm)
                            <div class="flex items-center justify-end">
                                <a href="{{ request()->fullUrlWithQuery(['export' => true]) }}"
                                   class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded text-gray-700 bg-white hover:bg-gray-50">
                                    Export
                                </a>
                            </div>
                        @endif
                    </div>

                    @if(!$selectedForm)
                        <div
                            class="border-4 border-dashed border-gray-200 rounded-lg h-96 flex items-center justify-center flex-col">
                            <p class="text-lg font-mono text-gray-500 px-4">Select a form to view/export its responses.</p>
                        </div>
                    @endif

                    @if($selectedForm)
                        @if($formDatas->count() > 0)
                            <div class="flex flex-col">
                                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">

                                        <x-auth-session-status class="mb-4" :status="session('status')"/>

                                        <div
                                            class="shadow overflow-x-auto border-b border-gray-200 sm:rounded-lg">

                                            <table class=" divide-y divide-gray-200 table-fixed w-full">
                                                <thead class="bg-gray-50">
                                                <tr>
                                                    @foreach($headers as $j=>$header)
                                                        @if($j>2) @break; @endif
                                                        <th scope="col"
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            {{ $header }}
                                                        </th>
                                                    @endforeach
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Actions
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach($rows as $i=>$row)
                                                    <tr class="break-words">
                                                        @foreach($row as $index=>$val)
                                                            @if($index>2) @break; @endif
                                                            <td class="w-10  px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                <div class="truncate">{{ $val }}</div>
                                                            </td>
                                                        @endforeach
                                                        <td class="w-10 px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            <div class="space-x-2">
                                                                <a href="{{ route('admin.responses.show', $responseIds[$i]) }}"
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

                        @if($formDatas->count() == 0)
                            <div class="flex flex-col">
                                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                        <div
                                            class="border-4 border-dashed border-gray-200 rounded-lg h-96 flex items-center justify-center flex-col">
                                            <p class="text-lg font-mono text-gray-500">
                                                No response collected yet, bet it is coming soon!
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @endif


                @if(!$hasForm)
                    <div
                        class="border-4 border-dashed border-gray-200 rounded-lg h-96 flex items-center justify-center flex-col">
                        <p class="text-lg font-mono text-gray-500">You have not created any form yet.</p>
                        <p class="text-lg font-mono block text-gray-500">
                            <a href="{{ route('admin.forms.create') }}" class="text-gray-900">
                                Create </a> your first form now!
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="module" src="{{ asset('js/app.js') }}"></script>
@endpush
