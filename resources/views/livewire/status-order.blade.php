<div>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">

        <div class="bg-white rounded-lg shadow-lg px-12 py-8 mb-6 flex items-center">

            <div class="relative">
                <div class="{{ ($order->status >= 2 && $order->status != 5)?'bg-blue-400':'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">
                    <i class="fas fa-check text-white"></i>
                </div>
                <div class="absolute -left-1.5 mt-0.5">
                    <p>Recibido</p>
                </div>
            </div>

            <div class="{{ ($order->status >= 3 && $order->status != 5)?'bg-blue-400':'bg-gray-400' }} h-1 flex-1 mx-2"></div>

            <div class="relative">
                <div class="{{ ($order->status >= 3 && $order->status != 5)?'bg-blue-400':'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">
                    <i class="fas fa-truck text-white"></i>
                </div>
                <div class="absolute -left-1 mt-0.5">
                    <p>Enviado</p>
                </div>
            </div>

            <div class="{{ ($order->status >= 4 && $order->status != 5)?'bg-blue-400':'bg-gray-400' }} h-1 flex-1 mx-2"></div>

            <div class="relative">
                <div class="{{ ($order->status >= 4 && $order->status != 5)?'bg-blue-400':'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">
                    <i class="fas fa-check text-white"></i>
                </div>
                <div class="absolute -left-1.5 mt-0.5">
                    <p>Entregado</p>
                </div>
            </div>

        </div>

        <div class="bg-white rounded-lg shadow-lg py-4 px-6 mb-6">
            <p class="text-gray-700 uppercase">
                <span class="font-bold">Número de orden: </span>O-0123-55-{{ $order->id }}
            </p>
            <form wire:submit.prevent="update">
                <div class="flex space-x-3 mt-2">
                    <x-jet-label>
                        <input wire:model="status" type="radio" name="status" value="2" class="mr-2">
                        Recibido
                    </x-jet-label>
                    <x-jet-label>
                        <input wire:model="status" type="radio" name="status" value="3" class="mr-2">
                        Enviado
                    </x-jet-label>
                    <x-jet-label>
                        <input wire:model="status" type="radio" name="status" value="4" class="mr-2">
                        Entregado
                    </x-jet-label>
                    <x-jet-label>
                        <input wire:model="status" type="radio" name="status" value="5" class="mr-2">
                        Cancelado
                    </x-jet-label>
                </div>

                <div class="flex mt-2">
                    <x-jet-button class="ml-auto">
                        Actualizar
                    </x-jet-button>
                </div>
            </form>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <h1 class="font-bold uppercase mb-4">Detalle del envío</h1>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="md:grid-cols-1">
                    <p class="font-semibold uppercase mb-2">Dirección</p>
                    @if ($order->envio_type == 1)
                        <p class="text-sm">Los productos serán recogidos en tienda</p>
                        <p class="text-sm">Calle Fake 123, Orizaba, Veracruz</p>
                    @else
                        {{-- <p class="text-sm">Los productos serán enviados a:</p> --}}
                        <p class="text-sm">{{ $envio->address }}</p>
                        <p class="text-sm">{{ $envio->references }}</p>
                        <p class="text-sm">{{ $envio->department }}, {{ $envio->city }} - {{ $envio->district }}</p>
                    @endif
                </div>
                <div class="md:grid-cols-1">
                    <p class="font-semibold uppercase mb-2">Datos de contacto</p>
                    <p class="text-sm">Nombre: {{ $order->contact }}</p>
                    <p class="text-sm">Teléfono: {{ $order->phone }}</p>
                </div>
                @if ($order->envio_type == 2)
                    <div wire:ignore id="map" class="md:col-span-2 h-56 w-full"></div>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYv0DMgn6Zn0jVValBV6k03zrZ5YoKEMY&callback=initMap"
                            async>
                    </script>
                    <script>
                        let map;
                        function initMap() {
                            map = new google.maps.Map(document.getElementById('map'), {
                                zoom: 14,
                                center: new google.maps.LatLng("{{ $envio->latitud }}","{{ $envio->longitud }}"),
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                            });
                            vMarker = new google.maps.Marker({
                                position: new google.maps.LatLng("{{ $envio->latitud }}","{{ $envio->longitud }}"),
                                draggable: false
                            });
                            map.setCenter(vMarker.position);
                            vMarker.setMap(map);
                        }
                    </script>
                @endif
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6 text-gray-700 mb-6">
            <h1 class="uppercase font-bold mb-4">Resumen de la compra</h1>
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th></th>
                        <th>Precio</th>
                        <th>Cant</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach ($items as $item)
                        <tr>
                            <td>
                                <div class="flex items-center">
                                    <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}" alt="">
                                    <article>
                                        <h1 class="font-bold">{{ $item->name }}</h1>
                                    </article>
                                </div>
                            </td>
                            <td class="text-center">
                                $ {{ $item->price }}
                            </td>
                            <td class="text-center">
                                {{ $item->qty }}
                            </td>
                            <td class="text-center">
                                $ {{ $item->price * $item->qty }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
