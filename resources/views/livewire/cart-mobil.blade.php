<div>
    <a href="{{ route('shopping-cart') }}" class="py-4 px-6 text-lg flex items-center text-trueGray-500 hover:bg-greenLime-500 hover:text-white">
        <span class="flex justify-center w-7 mr-1">
            <x-cartIcon size="28" color="#737373" />
        </span>
        <span class="relative inline-block pr-4">
            Mi carrito
            @if (Cart::count())
                <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{Cart::count()}}</span>
            @else
                <span class="absolute top-0 right-0 inline-block w-2 h-2 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full"></span>
            @endif
        </span>
    </a>
</div>
