<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
    <h1 class="text-3xl text-center font-semibold mb-8">Crear un nuevo producto</h1>
    <div class="grid grid-cols-2 gap-6 mb-4">
        {{-- Categoría --}}
        <div>
            <x-jet-label value="Categorías" />
            <select class="w-full form-control" wire:model="category_id">
                <option value="" disabled selected>Seleccione una categoría</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{ $category->name }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="category_id" />
        </div>
        <div>
            <x-jet-label value="Vendido por:" />
            <x-jet-input class="w-full" type="text" placeholder="Escriba el nombre del vendedor"
                         wire:model="seller"/>
            <x-jet-input-error for="seller" />
            <!--
            <select class="w-full form-control" wire:model="subcategory_id">
                <option value="" selected disabled>Seleccione un vendedor</option>
                {{-- @foreach ($subcategories as $subcategory)
                    <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                @endforeach --}}
            </select>
            -->
        </div>
    </div>
    {{-- Nombre --}}
    <div class="mb-4">
        <x-jet-label value="Nombre" />
        <x-jet-input class="w-full" type="text" placeholder="Escriba el nombre del producto"
                     wire:model="name"/>
        <x-jet-input-error for="name" />
    </div>
    {{-- Slug --}}
    <div class="mb-4">
        <x-jet-label value="Slug" />
        <x-jet-input class="w-full bg-gray-200"
                     type="text" placeholder="Escriba el slug del producto"
                     wire:model="slug"
                     disabled/>
        <x-jet-input-error for="slug" />
    </div>
    {{-- Descripción --}}
    <div class="mb-4">
        <div wire:ignore>
            <x-jet-label value="Descripción" />
            <textarea class="w-full form-control" rows="4"
                    wire:model="description"
                    x-data
                    x-init="ClassicEditor
                            .create($refs.miEditor)
                            .then(function(editor){
                                editor.model.document.on('change:data', () => {
                                    @this.set('description', editor.getData())
                                })
                            })
                            .catch( error => {
                                console.error( error );
                            } );"
                    x-ref="miEditor"></textarea>
        </div>
        <x-jet-input-error for="description" />
    </div>
    {{--  --}}
    <div class="grid grid-cols-2 gap-6 mb-4">
        {{-- Precio --}}
        <div>
            <x-jet-label value="Precio" />
            <x-jet-input class="w-full"
                         type="number" 
                         step=".01"
                         placeholder="Digite el precio del producto"
                         wire:model="price" />
            <x-jet-input-error for="price" />
        </div>
        {{-- Stock --}}
        <div>
            <x-jet-label value="Stock" />
            <x-jet-input class="w-full"
                         type="number" placeholder="Digite el stock del producto"
                         wire:model="quantity" />
            <x-jet-input-error for="quantity" />
        </div>
    </div>
    {{-- Botón --}}
    <div class="flex mt-4">
        <x-jet-button class="ml-auto"
                      wire:loading.attr="disabled"
                      wire:target="save"
                      wire:click="save">
            Crear producto
        </x-jet-button>
    </div>
</div>
