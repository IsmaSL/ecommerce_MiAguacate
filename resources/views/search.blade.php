<x-app-layout>
    <div class="container py-8">
        <ul>
            @forelse ($products as $product)
                <x-product-list :product="$product" />
            @empty
                <li class="bg-white rounded-lg shadow-xl">
                    <div class="py-5 px-8 flex items-center text-xl text-gray-700 ">
                        <p class="font-semibold">No se encontraron productos con ese nombre, vuelve a intentarlo.</p>
                        <i class="fas fa-exclamation-triangle ml-auto"></i>
                    </div>
                </li>
            @endforelse
        </ul>

        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>