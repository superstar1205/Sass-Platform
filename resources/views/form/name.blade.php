<div class="relative">
    <div class="mb-3">
        <div class="flex">
            <label for="{{ $id }}"
                   class="text-lg font-semibold text-gray-600 leading-snug tracking-tight">
                {{$label}}
            </label>
            @if($required)<span class="inline-block w-1"></span><span class="text-gray-500">*</span>@endif
        </div>
        <div class="text-gray-500 block">{{ $help }}</div>
    </div>
    <div class="relative">
        <input id="{{ $id }}"
               name="{{ $id }}"
               class="block w-full px-4 py-3 pr-8 md:pr-4 rounded text-gray-900 border-gray-200 focus:border-gray-200 focus:ring-2 focus:ring-gray-100"
               type="text"
               @if($required) required @endif
               placeholder="{{ $placeholder }}"
               autocomplete="name"
               value=""
        >
    </div>
</div>
