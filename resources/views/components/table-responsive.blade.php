<!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-3 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow-xl overflow-hidden border-b border-gray-200">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>