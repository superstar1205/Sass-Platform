<div class="relative">
    <div class="mb-3">
        <div class="flex">
            <label contenteditable="true" data-placeholder="Enter a question" class="text-lg font-semibold text-gray-600 leading-snug tracking-tight cursor-text focus:outline-none">
            </label>
            <span class="inline-block w-1">{{ $label }}</span>
            <span class="text-gray-500">*</span>
        </div>
        <div class="focus-within:not-sr-only sr-only">
            <div>
                <div contenteditable="true" tabindex="0" class="help-text cursor-text focus:outline-none">
                    <p data-placeholder="Write a help text" class="is-empty"></p>
                </div>
            </div>
        </div>
    </div>
    <div class="grid gap-1 grid-rows-[auto,1fr] md:gap-2 grid-cols-11">
        @for($i = $min; $i <= $max; $i++)
            <button value="{{ $i }}" class='group aspect-w-1 aspect-h-1 focus:outline-none bg-white opacity-30 hover:opacity-100'>
                <div style="--theme-ring-default:transparent;" class="flex justify-center items-center theme-border theme-ring rounded cursor-pointer border">
                    <span class="font-medium text-gray-700">{{ $i }}</span>
                </div>
            </button>
        @endfor
    </div>

</div>