<div>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-2xl text-gray-00 leading-tight">
                Lista de productos
            </h2>
    
            <x-button-enlace class="ml-auto" href="{{ route('admin.products.create') }}">
                Nuevo producto
            </x-button-enlace>
        </div>
    </x-slot>
    <div class="container p-12">
        <div class="px-6 py-6 bg-white rounded-t-xl shadow-xl">
            <x-jet-input class="w-full" type="text" placeholder="Buscar producto..."
                         wire:model="search"/>
        </div>
        <x-table-responsive>
            @if ($products->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Cantidad
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Estado
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Precio
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Editar</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($products as $product)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 object-cover">
                                            @if ($product->images->count())
                                                <img class="h-10 w-10 rounded-full" src="{{ Storage::url($product->images->first()->url) }}" alt="">
                                            @else
                                                {{-- <img class="h-10 w-10 rounded-full" src="" alt=""> --}}
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                        width="40" height="40"
                                                        viewBox="0 0 172 172"
                                                        style=" fill:#000000;">
                                                    <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                                        <path d="M0,172v-172h172v172z" fill="none"></path>
                                                        <g fill="#95a5a6">
                                                            <path d="M0,17.2v137.6h172v-137.6zM6.88,24.08h158.24v89.44h-36.73812l-24.08,-17.2h-20.3175l-14.05563,-14.05562l-16.74312,3.35937l-14.80813,-22.22562l-31.4975,31.4975zM129,44.72c-8.50594,0 -15.48,6.97406 -15.48,15.48c0,8.50594 6.97406,15.48 15.48,15.48c8.50594,0 15.48,-6.97406 15.48,-15.48c0,-8.50594 -6.97406,-15.48 -15.48,-15.48zM129,51.6c4.78375,0 8.6,3.81625 8.6,8.6c0,4.78375 -3.81625,8.6 -8.6,8.6c-4.78375,0 -8.6,-3.81625 -8.6,-8.6c0,-4.78375 3.81625,-8.6 8.6,-8.6zM37.3025,74.20188l12.71188,19.05437l17.65687,-3.52062l13.46438,13.46437h20.9625l24.08,17.2h38.94187v27.52h-158.24v-43.29562z"></path>
                                                        </g>
                                                    </g>
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $product->name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $product->quantity }} Kgs.</div>
                                    {{-- <div class="text-sm text-gray-500">Optimization</div> --}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @switch($product->status)
                                        @case(1)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Borrador
                                                </span>
                                            @break
                                        @case(2)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Publicado
                                                </span>
                                            @break
                                        @default
                                            
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    $ {{ $product->price }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="px-6 py-4">
                    No se encontraron coincidencias
                </div>
            @endif
        </x-table-responsive>
        @if ($products->hasPages())
            <div class="mt-3 px-6 py-4 bg-white rounded-b-xl shadow-xl">
                {{ $products->links() }}
            </div>
        @endif
    </div>
    
  
</div>
