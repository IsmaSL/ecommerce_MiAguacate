<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-greenLime-500">
    {{-- <div>
        {{ $logo }}
    </div> --}}

    <div class="md:w-80 lg:w-full sm:max-w-md mx-6 p-6 md:my-6 bg-white shadow-xl overflow-hidden rounded-lg">
        <div class="flex flex-col items-center my-4">
            {{ $logo }}
        </div>

        {{ $slot }}
    </div>
</div>
