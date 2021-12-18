<div>
    <div class="grid grid-cols-1 lg:grid-cols-5 xl:grid-cols-5 gap-6 container py-8">
        <div class="xl:col-span-3 text-gray-700">
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <p class="text-gray-700 uppercase">
                    <span class="font-bold">Número de orden: </span>O-0123-55-{{ $order->id }}
                </p>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <h1 class="font-bold uppercase mb-4">Detalle del envío</h1>
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="font-semibold uppercase mb-2">Dirección</p>
                        @if ($order->envio_type == 1)
                            <p class="text-sm">Los productos serán recogidos en tienda</p>
                            <p class="text-sm">Calle Fake 123, Orizaba, Veracruz</p>
                        @else
                            {{-- <p class="text-sm">Los productos serán enviados a:</p> --}}
                            <p class="text-sm">{{ $envio->address }}</p>
                            <p class="text-sm">{{ $envio->department }}, {{ $envio->city }} - {{ $envio->district }}</p>
                        @endif
                    </div>
                    <div>
                        <p class="font-semibold uppercase mb-2">Datos de contacto</p>
                        <p class="text-sm">Nombre: {{ $order->contact }}</p>
                        <p class="text-sm">Teléfono: {{ $order->phone }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 text-gray-700 mb-6">
                <h1 class="uppercase font-bold mb-4">Resumen del carrito</h1>
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
        <div class="xl:col-span-2" x-data="{ pago_type: 1 }">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h1 class="uppercase font-bold mb-4">Método de pago</h1>
                <p class="text-sm mb-6">Seleccione el método de pago de su preferencia.</p>
                <div class="grid grid-cols-2 divide-x">
                    <div class="col-span-1">
                        <label class="flex items-center mb-4 cursor-pointer">
                            <input x-model="pago_type" type="radio" class="text-gray-600 cursor-pointer" 
                                                name="pago_type"
                                                value="1">
                            <img class="h-14 ml-3" src="{{ asset('img/PP2.png') }}">
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input x-model="pago_type" type="radio" class="text-gray-600 cursor-pointer" 
                                                name="pago_type"
                                                value="2">
                            <img class="h-14 ml-3" src="{{ asset('img/PE.png') }}">
                        </label>
                    </div>
                    {{-- <img class="h-8" src="{{ asset('img/MC_VI_DI_2-1.jpg') }}" alt=""> --}}
                    <div class="col-span-1 text-gray-700 ml-4">
                        <table class="table-auto font-semibold mx-auto">
                            <tbody>
                                <tr>
                                    <td class="text-sm">Subtotal:</td>
                                    <td class="text-right text-sm">$ {{ $order->total - $order->shipping_cost }}</td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Envío:</td>
                                    <td class="text-right text-sm">
                                        @if ($order->shipping_cost > 0)
                                            $ {{ $order->shipping_cost }}.00
                                        @else
                                            <span class=" text-greenLime-600">Gratis</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-left text-xl">Total:</th>
                                    <th class="text-right text-xl">$ {{ $order->total }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="mt-10">
                    <div id="paypal-button-container" class="hidden" :class="{ 'hidden': pago_type != 1 }"></div>
                    <div class="hidden" :class="{ 'hidden': pago_type != 2 }">
                        <x-button class="w-full h-11 font-bold" color="greenLime"
                                  wire:loading.attr="disabled"
                                  wire:target="payOrder"
                                  wire:click="payOrder">
                            Realizar pedido
                        </x-button>
                    </div>
                    {{-- <div class="cho-container mt-4"></div> --}}
                </div>
            </div>
        </div>
    </div>

    @push('script')
    <script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&currency=MXN">
    </script>
    
    <script>
      
        paypal.Buttons({

            // Sets up the transaction when a payment button is clicked
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                    amount: {
                        value: "{{ $order->total }}"
                    }
                    }]
                });
            },

            // Finalize the transaction after payer approval
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                    // Successful capture! For dev/demo purposes:
                        // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                        var transaction = orderData.purchase_units[0].payments.captures[0];

                        Livewire.emit('payOrder');

                        // alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                    // When ready to go live, remove the alert and show a success message within this page. For example:
                    // var element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '';
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    // Or go to another URL:  actions.redirect('thank_you.html');
                });
            }
        }).render('#paypal-button-container');
    </script>
    @endpush
</div>
