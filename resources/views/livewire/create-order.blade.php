<div class="container py-8 grid lg:grid-cols-2 xl:grid-cols-5 gap-6">
    <div class="lg:col-span-1 xl:col-span-3">
        <div class="bg-white grid lg:grid-cols-2 gap-6 rounded-lg shadow p-6">
            <div class="lg:col-span-1">
                <x-jet-label value="Nombre de contácto" />
                <x-jet-input type="text" wire:model.defer="contact"
                    placeholder="Nombre de quien recibirá el envío" class="w-full" />
                <x-jet-input-error for="contact" />
            </div>
            <div class="lg:col-span-1">
                <x-jet-label value="Teléfono de contacto" />
                <x-jet-input type="text" wire:model.defer="phone" placeholder="Ingrese un número de contacto"
                    class="w-full" />
                <x-jet-input-error for="phone" />
            </div>
        </div>
        <div x-data="{ envio_type: @entangle('envio_type') }">
            <p class="mt-6 mb-3 text-lg text-gray-700 font-semibold">Envíos</p>
            <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center mb-4">
                <input x-model="envio_type" type="radio" value="1" name="envio_type" class="text-gray-600">
                <span class="ml-2 text-gray-700">Recojer en tienda</span>
                <span class="font-semibold text-greenLime-600 ml-auto">Gratis</span>
            </label>
            <div class="bg-white rounded-lg shadow mb-4">
                <label class="px-6 py-4 flex items-center">
                    <input x-model="envio_type" type="radio" value="2" name="envio_type" 
                           class="text-gray-600">
                    <span class="ml-2 text-gray-700">Envío a domicilio</span>
                    <span class="font-semibold text-greenLime-600 ml-auto"></span>
                </label>
                <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden': envio_type != 2 }">
                    {{-- Estado --}}
                    <div>
                        <x-jet-label value="Estado" />
                        <select class="form-control w-full" wire:model="department_id">
                            <option value="" disabled selected>Seleccione un estado</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="department_id" />
                    </div>
                    {{-- Ciudad --}}
                    <div>
                        <x-jet-label value="Ciudad" />
                        <select class="form-control w-full" wire:model="city_id">
                            <option value="" disabled selected>Seleccione una ciudad</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="city_id" />
                    </div>
                    {{-- Colonia --}}
                    <div>
                        <x-jet-label value="Colonia" />
                        <select class="form-control w-full" wire:model="district_id">
                            <option value="" disabled selected>Seleccione una colonia</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="district_id" />
                    </div>
                    {{-- Dirección --}}
                    <div>
                        <x-jet-label value="Dirección" />
                        <x-jet-input type="text" class="w-full" wire:model="address" />
                        <x-jet-input-error for="address" />
                    </div>
                    {{-- Referencia --}}
                    <div class="col-span-2">
                        <x-jet-label value="Referencias" />
                        <x-jet-input type="text" class="w-full" wire:model="references" />
                        <x-jet-input-error for="references" />
                    </div>
                    
                </div>
            </div>
        </div>
        {{-- Mapa --}}
        <div class="bg-white rounded-lg shadow p-6">
            @if ($envio_type == 1)
                <x-jet-label value="Ubicación de la tienda" class="mb-2"/>
            @else
                <x-jet-label value="Seleccione su ubicación en el mapa" class="mb-2"/>
            @endif
            <div wire:ignore id="map" class="h-52 w-full"></div>

            <x-jet-input-error for="latitud" />
            <x-jet-input-error for="longitud" />
        </div>
    </div>

    <div class="lg:col-span-1 xl:col-span-2">
        <div class="bg-white rounded-lg shadow p-6">
            <ul>
                @forelse (Cart::content() as $item)
                    <li class="flex px-4 py-2 border-b border-gray-200">
                        <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}" alt="">
                        <article class="flex-1">
                            <h1 class="font-bold">{{ $item->name }}</h1>
                            <p>Cant: {{ $item->qty }}</p>
                            <p>$ {{ $item->price }}</p>
                        </article>
                    </li>
                @empty
                    <li class="py-6 px-4">
                        <p class="text-center">No hay productos aún en el carrito.</p>
                    </li>
                @endforelse
            </ul>
            <hr class="mt-4 mb-3">
            <div class="text-gray-700">
                <p class="flex justify-between items-center">
                    Subtotal
                    <span class=" font-semibold">$ {{ Cart::subtotal() }}</span>
                </p>
                <p class="flex justify-between items-center">
                    Envío
                    <span class="font-semibold text-greenLime-600 ml-auto">
                        @if ($envio_type == 1 || $shipping_cost == 0)
                            Gratis
                        @else
                            $ {{ $shipping_cost }}.00
                        @endif
                    </span>
                </p>
                <hr class="mt-4 mb-3">
                <p class="flex justify-between items-center font-semibold">
                    <span class="text-lg">Total</span>
                    @if ($envio_type == 1)
                        $ {{ Cart::subtotal() }}
                    @else
                        $ {{ Cart::subtotal() + $shipping_cost }}
                    @endif

                </p>
            </div>
        </div>
        <div class="text-right">
            <x-jet-button wire:loading.attr="disabled" wire:tarjet="create_order"
                class="mt-6 mb-4 py-3 justify-center w-full" wire:click="create_order">
                Ir al pago
            </x-jet-button>
            <hr>
            <p class="text-sm text-gray-700 mt-2 text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Ab mollitia exercitationem eligendi, inventore itaque deleniti aliquam ipsum corporis. Laudantium hic
                ullam voluptates quae eos id tempore provident a omnis quo? <a href=""
                    class="font-semibold text-greenLime-500">Politicas y privacidad</a></p>
        </div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYv0DMgn6Zn0jVValBV6k03zrZ5YoKEMY&callback=initMap"
        async>
</script>
<script>
    let map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            center: new google.maps.LatLng(18.854015, -97.106802),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        vMarker = new google.maps.Marker({
            position: new google.maps.LatLng(18.854015, -97.106802),
            draggable: true
        });
        google.maps.event.addListener(vMarker, 'dragend', function (evt) {
            @this.set('latitud',evt.latLng.lat().toFixed(6));
            @this.set('longitud',evt.latLng.lng().toFixed(6));
            map.panTo(evt.latLng);
        });
        map.setCenter(vMarker.position);
        vMarker.setMap(map);
    }
</script>