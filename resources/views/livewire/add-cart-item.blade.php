<div x-data>
    <p class="text-gray-700 mb-4">
        <span class="font-semibold text-lg">Stock disponible: </span>{{ $quantity }} Kg.
    </p>
    <div class="flex">
        <div class="mr-4">
            <x-jet-secondary-button disabled
                                    x-bind:disabled="$wire.qty <= 1"
                                    wire:loading.attr="disabled"
                                    wire:target="decrement"
                                    wire:click="decrement">
                <span class="text-sm">–</span>
            </x-jet-secondary-button>
            <span class="mx-2 text-gray-700 font-semibold">{{ $qty }}</span>
            <x-jet-secondary-button 
                                    x-bind:disabled="$wire.qty >= $wire.quantity"
                                    wire:loading.attr="disabled"
                                    wire:target="increment"
                                    wire:click="increment">
                <span class="text-sm">+</span>
            </x-jet-secondary-button>
        </div>
        <div class="flex-1">
            <x-button class="w-full" color="greenLime"
                x-bind:disabled="$wire.qty > $wire.quantity"
                wire:click="addItem"
                wire:loading.attr="disabled"
                wire:target="addItem">
                Agregar al carrito
            </x-button>
        </div>
    </div>
</div>
