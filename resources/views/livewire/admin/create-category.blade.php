<div>
    <x-jet-form-section submit="save" class="mb-6">
        <x-slot name="title">
            Administrar categorías
        </x-slot>
        <x-slot name="description">
            Completa la información necesaria para poder crear una categoría nueva.
        </x-slot>
        <x-slot name="form">
            <div class="col-span-6 sm:col-span-6">
                <x-jet-label>
                    Nombre
                </x-jet-label>
                <x-jet-input type="text" class="w-full mt-1" wire:model="createForm.name" />
                <x-jet-input-error for="createForm.name" />
            </div>
            <div class="col-span-6 sm:col-span-6">
                <x-jet-label>
                    Slug
                </x-jet-label>
                <x-jet-input type="text" disabled class="w-full mt-1 bg-gray-100" wire:model="createForm.slug" />
                <x-jet-input-error for="createForm.slug" />
            </div>
            <div class="col-span-6 sm:col-span-6">
                <x-jet-label>
                    Icono
                </x-jet-label>
                <x-jet-input type="text" class="w-full mt-1" wire:model.defer="createForm.icon" />
                <x-jet-input-error for="createForm.icon" />
            </div>
            <div class="col-span-6 sm:col-span-6">
                <x-jet-label>
                    Imagen
                </x-jet-label>
                {{-- <x-jet-input type="text" class="w-full mt-1"/> --}}
                <input type="file" class="w-full mt-1" accept="image/*" id="{{ $rand }}"
                    wire:model="createForm.image">
                <x-jet-input-error for="createForm.image" />
            </div>
        </x-slot>
        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                ¡Nueva categoría agregada!
            </x-jet-action-message>
            <x-jet-button>
                Agregar
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>

    <x-jet-action-section>
        <x-slot name="title">
            Lista de Categorias
        </x-slot>
        <x-slot name="description">
            Aquí encontraras las categorias agregadas.
        </x-slot>
        <x-slot name="content">
            <table class=" text-gray-700">
                <thead class="border-b border-gray-300">
                    <tr class="text-left">
                        <th class="py-2 w-full">Nombre</th>
                        <th class="py-2">Acción</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @foreach ($categories as $category)
                        <tr>
                            <td class="py-2">
                                <span class="inline-block w-8 text-center mr-2">
                                    {!! $category->icon !!}
                                </span>
                                <span class="uppercase">
                                    {{ $category->name }}
                                </span>
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit('{{$category->slug}}')">Editar</a>
                                    <a class="pl-2 hover:text-red-600 cursor-pointer" wire:click="$emit('deleteCategory', '{{$category->slug}}')">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-jet-action-section>

    <x-jet-dialog-modal wire:model="editForm.open">
        <x-slot name="title">
            Editar Categoría
        </x-slot>

        <x-slot name="content">
            <div class="space-y-3">
                <div>
                @if ($editImage)
                    <img class="w-full h-64 object-cover object-center" src="{{$editImage->temporaryUrl()}}" alt="">
                @else
                    <img class="w-full h-64 object-cover object-center" src="{{Storage::url($editForm['image'])}}" alt="">
                @endif                
                </div>
                <div>
                    <x-jet-label>
                        Nombre
                    </x-jet-label>
                    <x-jet-input type="text" class="w-full mt-1" wire:model="editForm.name" />
                    <x-jet-input-error for="editForm.name" />
                </div>
                <div>
                    <x-jet-label>
                        Slug
                    </x-jet-label>
                    <x-jet-input type="text" disabled class="w-full mt-1 bg-gray-100" wire:model="editForm.slug" />
                    <x-jet-input-error for="editForm.slug" />
                </div>
                <div>
                    <x-jet-label>
                        Icono
                    </x-jet-label>
                    <x-jet-input type="text" class="w-full mt-1" wire:model.defer="editForm.icon" />
                    <x-jet-input-error for="editForm.icon" />
                </div>
                <div>
                    <x-jet-label>
                        Imagen
                    </x-jet-label>
                    {{-- <x-jet-input type="text" class="w-full mt-1"/> --}}
                    <input type="file" class="w-full mt-1" accept="image/*" id="{{ $rand }}"
                        wire:model="editImage">
                    <x-jet-input-error for="editImage" />
                </div>
            </div>
        </x-slot>
    
        <x-slot name="footer">
            <x-jet-danger-button wire:click="update"
                                 wire:loading.attr="disabled"
                                 wire:target="editImage, update">
                Actualizar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    @push('script')
        <script>
            Livewire.on('deleteCategory', categorySlug => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('admin.create-category', 'delete', categorySlug);
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            });
        </script>
    @endpush
</div>
