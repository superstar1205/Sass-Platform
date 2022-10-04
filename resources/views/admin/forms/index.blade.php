@extends('layouts.app')



@section('navigation')
    <x-nav current="forms"/>
@endsection

@section('content')
    <div class="max-w-7xl space-y-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">Forms</h1>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="py-8 space-y-2">

                <div class="flex items-center justify-end">
                    <a href="{{ route('admin.forms.create') }}"
                       class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded text-gray-700 bg-white hover:bg-gray-50">
                        New Form
                    </a>
                </div>

                @if($forms->count() == 0)
                    <div class="border-4 border-dashed border-gray-200 rounded-lg h-96 flex items-center justify-center flex-col">
                        <p class="text-lg font-mono text-gray-500">You have not created any form yet.</p>
                        <p class="text-lg font-mono block text-gray-500">
                            <a href="{{ route('admin.forms.create') }}" class="text-gray-900">
                                Create </a> your first form now!
                        </p>
                    </div>
                @endif

                @if($forms->count() > 0)
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Title') }}
                                        </th>
                                        @if(auth()->user()->is_admin)
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('User') }}
                                        </th>
                                        @endif
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Created') }}
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Actions') }}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($forms as $form)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $form->title }}
                                            </td>
                                            @if(auth()->user()->is_admin)
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ optional($form->user)->name }}
                                                </td>
                                            @endif
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $form->created_at }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <div class="space-x-2">
                                                    <a href="{{ route('admin.forms.edit', $form->id) }}" class="text-xs font-medium hover:text-gray-700">
                                                        Edit
                                                    </a>
                                                    @if($canShare)
                                                    <a target="_blank"
                                                        href="{{route('forms.responses.create', [$form->slug_form_id])}}"
                                                            class="inline-flex items-center px-2.5 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50">
                                                        Share
                                                    </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="py-4">
                                {{ $forms->appends(\Request::except('page'))->links() }}
                            </div>
                        </div>

                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
@endsection
