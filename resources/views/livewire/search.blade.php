<div class="flex-1 relative mx-3" x-data>
    <form action="{{route('search')}}" autocomplete="off">
        <x-jet-input name="name" wire:model="search" type="text" class="w-full" placeholder="¿Qué producto estás buscando?"/>
        <button class="absolute top-0 right-0 w-12 h-full flex items-center justify-center bg-greenLime-500 hover:bg-greenLime-400 rounded-r-md">
            <x-searchIcon size="25"/>
        </button>
    </form>

    <div class="absolute w-full" @click.away="$wire.open = false">
        <div class="bg-white rounded-lg shadow-lg mt-2 hidden" :class="{ 'hidden': !$wire.open }">
            <div class="p-2">
                @forelse ($products as $product)
                    <a href="{{ route('products.show', $product) }}" class="flex hover:bg-gray-100 rounded-lg p-2">
                        <img class="w-16 h-12 object-cover rounded" src="{{ Storage::url($product->images->first()->url) }}" alt="">
                        <div class="ml-4 text-gray-700">
                            <p class=" text-lg font-semibold leading-5">{{ $product->name }}</p>
                            <p class=" text-sm"> Categoría: {{$product->category->name}}</p>
                        </div>
                    </a>
                @empty
                    <p class="text-lg py-2 ml-4">No se encontraron productos con ese nombre... </p>
                @endforelse
            </div>
        </div>
    </div>
</div>
