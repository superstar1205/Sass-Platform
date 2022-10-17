<div class="min-h-screen flex flex-col">
    <div class="form-container w-full max-w-base mx-auto px-4 py-16">
        @if ($form)
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg  px-5 px-2 bg-white">
                {!! $form->render() !!}
            </div>
        @elseif($thinkYouPage)
            {!! $thinkYouPage->render() !!}
        @endif
    </div>
</div>
