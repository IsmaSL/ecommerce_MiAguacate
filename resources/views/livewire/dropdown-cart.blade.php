<div>
    <x-jet-dropdown width="96">
        <x-slot name="trigger">
            <span class="relative inline-block cursor-pointer">
                <x-cartIcon size="28" />
                @if (Cart::count())
                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{Cart::count()}}</span>
                @else
                    <span class="absolute top-0 right-0 inline-block w-2 h-2 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full"></span>
                @endif
            </span>
        </x-slot>
        <x-slot name="content">
            <ul>
                @forelse (Cart::content() as $item)
                    <li class="flex px-4 py-2 border-b border-gray-200">
                        <img class="h-15 w-20 object-cover mr-4" src="{{$item->options->image}}" alt="">
                        <article class="flex-1">
                            <h1 class="font-bold">{{$item->name}}</h1>
                            <p>Cant: {{$item->qty}}</p>
                            <p>$ {{$item->price}}</p>
                        </article>
                    </li>
                @empty
                    <li class="py-6 px-4">
                        <p class="text-center">No hay productos aún en el carrito.</p>
                    </li>
                @endforelse
            </ul>

            @if (Cart::count())
                <div class="px-4 py-2">
                    <p class="flex items-center text-lg text-gray-700 mt-2 mb-3 px-1">
                        <span class="font-bold">Total:  </span> 
                        <span class="font-semibold ml-auto">${{ Cart::subtotal() }}</span> 
                    </p>

                    <x-button-enlace href="{{ route('shopping-cart') }}" color="greenLime" class="w-full">
                        Ir al carrito
                    </x-button-enlace>
                </div>
            @endif
        </x-slot>
    </x-jet-dropdown>
</div>
