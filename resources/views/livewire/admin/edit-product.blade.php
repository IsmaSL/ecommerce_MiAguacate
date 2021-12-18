<div>
    <header class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8 ">
            <div class="flex justify-between items-center">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">Productos</h1>
                <x-jet-danger-button wire:click="$emit('deleteProduct')">
                    Eliminar
                </x-jet-danger-button>
            </div>
        </div>
    </header>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
        <h1 class="text-3xl text-center font-semibold mb-8">Modificar información del producto</h1>
        
        <div class="mb-4" wire:ignore>
            <form action="{{ route('admin.products.files', $product) }}" method="POST"
                  class="dropzone" id="my-awesome-dropzone">
            </form>
        </div>
    
        @if ($product->images->count())
            <section class="bg-white shadow-xl rounded-lg p-6 mb-4">
                <h1 class="text-2xl text-center font-semibold mb-4">Imagenes del producto</h1>
                <ul class="flex flex-wrap gap-3">
                    @foreach ($product->images as $image)
                        <li class="relative" wire:key="image-{{ $image->id }}">
                            <img class="w-32 h-20 object-cover rounded-sm" src="{{ Storage::url($image->url) }}" alt="">
                            <x-jet-danger-button class="absolute right-2 top-2 w-0 h-1"
                                                 wire:click="deleteImage({{ $image->id }})"
                                                 wire:loading.attr="disabled"
                                                 wire:target="deleteImage({{ $image->id }})">
                                x
                            </x-jet-danger-button>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endif
    
        @livewire('admin.status-product', ['product' => $product], key('status-product-'.$product->id))

        <div class="bg-white shadow-xl rounded-lg p-6">
            {{-- Categoría --}}
            <div class="grid grid-cols-2 gap-6 mb-4">
                <div>
                    <x-jet-label value="Categorías" />
                    <select class="w-full form-control" wire:model="product.category_id">
                        <option value="" disabled selected>Seleccione una categoría</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="product.category_id" />
                </div>
                <div>
                    <x-jet-label value="Vendido por:" />
                    <x-jet-input class="w-full" type="text" placeholder="Escriba el nombre del vendedor"
                                 wire:model="product.seller"/>
                    <x-jet-input-error for="product.seller" />
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
                            wire:model="product.name"/>
                <x-jet-input-error for="product.name" />
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
                            wire:model="product.description"
                            x-data
                            x-init="ClassicEditor
                                    .create($refs.miEditor)
                                    .then(function(editor){
                                        editor.model.document.on('change:data', () => {
                                            @this.set('product.description', editor.getData())
                                        })
                                    })
                                    .catch( error => {
                                        console.error( error );
                                    } );"
                            x-ref="miEditor"></textarea>
                </div>
                <x-jet-input-error for="product.description" />
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
                                wire:model="product.price" />
                    <x-jet-input-error for="product.price" />
                </div>
                {{-- Stock --}}
                <div>
                    <x-jet-label value="Stock" />
                    <x-jet-input class="w-full"
                                type="number" placeholder="Digite el stock del producto"
                                wire:model="product.quantity" />
                    <x-jet-input-error for="product.quantity" />
                </div>
            </div>
            {{-- Botón --}}
            <div class="flex justify-end items-center mt-4">
    
                <x-jet-action-message class="mr-3" on="saved">
                    Actualizado
                </x-jet-action-message>
    
                <x-jet-button
                            wire:loading.attr="disabled"
                            wire:target="save"
                            wire:click="save">
                    Actualizar producto
                </x-jet-button>
            </div>
        </div>   
    </div>

    @push('script')
    <script>
        Dropzone.options.myAwesomeDropzone = {
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            dictDefaultMessage: "Arrastre una imagen al recuadro",
            acceptedFiles: 'image/*',
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 2, // MB
            complete: function(file) {
                this.removeFile(file);
            },
            queuecomplete: function() {
                Livewire.emit('refreshProduct');
            }
        };

        Livewire.on('deleteProduct', () => {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción no se podrá revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, borrarlo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('admin.edit-product', 'delete');
                    Swal.fire(
                        '¡Eliminado!',
                        'El producto ha sido eliminado.',
                        'success'
                    )
                }
            })
        })
    </script>
@endpush
</div>
