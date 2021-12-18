<div class="bg-white shadow-xl rounded-lg p-6 mb-4">
    <div class="flex items-center">
        <div class="mr-6">
            <p class="text-xl text-center font-semibold">Estado del producto:</p>
        </div>
        <div>
            <label class="mr-4">
                <input wire:model.defer="status" type="radio" name="status" value="1">
                Borrador
            </label>
            <label>
                <input wire:model.defer="status" type="radio" name="status" value="2">
                Publicado
            </label>
        </div>
        <div class="flex ml-auto items-center">
            <x-jet-action-message class="mr-3" on="saved">
                ¡Actualizado!
            </x-jet-action-message>
            <x-jet-button wire:click="save"
                            wire:loading.attr="disabled"
                            wire:target="saved">
                Actualizar estado
            </x-jet-button>
        </div>
    </div>
    
</div>