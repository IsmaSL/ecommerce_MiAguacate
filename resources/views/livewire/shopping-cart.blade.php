<div class="container py-8">
    <x-table-responsive>
        <div class="flex justify-between items-center px-6 py-4 bg-white rounded-t-xl">
            <div>
                <h1 class="text-lg font-semibold">Carrito de compras</h1>
            </div>
            @if (Cart::count())
                <div> 
                    <a class="text-sm cursor-pointer hover:underline hover:text-red-600 inline-block" 
                        wire:click="destroy">
                        <i class="fas fa-trash mr-2"></i>Vaciar carrito
                    </a>
                </div>
            @endif
        </div>
        @if (Cart::count())
            <div class="px-6 pb-4 bg-white">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nombre
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Precio
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Cantidad
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total
                            </th>
                            <th scope="col">

                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach (Cart::content() as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover object-center"
                                                src="{{ $item->options->image }}"
                                                alt="">
                                        </div>
                                        <div class="ml-4">
                                            <p class=" text-trueGray-700 font-bold">{{ $item->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class=" font-semibold">$ {{ $item->price }}</span>
                                </td>
                                <td>
                                    <div class="flex justify-center">
                                        @livewire('update-cart-item', ['rowId' => $item->rowId], key($item->rowId))
                                    </div>
                                </td>
                                <td class="text-center">
                                    $ {{$item->price * $item->qty}}
                                </td>
                                <td class="text-center">
                                    <a class="cursor-pointer text-gray-300 hover:text-red-500" 
                                        wire:click = "delete('{{$item->rowId}}')"
                                        wire:loading.class = "text-red-500 opacity-25"
                                        wire:target = "delete('{{$item->rowId}}')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="flex flex-col items-center bg-white">
                <i class="fas fa-shopping-cart text-3xl text-gray-700"></i>
                <p class="text-lg text-gray-700 my-4">
                    Tu carrito de compras está vacío.
                </p>
                <x-button-enlace href="/" class="px-16 mb-8">
                    Ir de compras
                </x-button-enlace>
            </div>
        @endif
    </x-table-responsive>

    @if (Cart::count())
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mt-6">
            <div class="flex justify-between items-center">
                <div>
                    <p class=" text-gray-700">
                        <span class=" font-bold text-lg">Total: </span>
                        $ {{Cart::subTotal()}}
                    </p>
                </div>
                <div>
                    <x-button-enlace href="{{ route('orders.create') }}">
                        Continuar
                    </x-button-enlace>
                </div>
            </div>
        </div>
    @endif
</div>
