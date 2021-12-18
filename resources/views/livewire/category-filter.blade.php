<div>
    <div class="bg-white rounded-lg shadow-lg mb-4">
        <div class="px-6 py-2 flex justify-between items-center">
            <h1 class="font-bold text-gray-700 uppercase">{{ $category->name }}</h1>
            <div class="hidden md:block grid grid-cols-2 border border-gray-200 divide-x divide-gray-200">
                <i class=" fas fa-border-all p-3 text-gray-500 cursor-pointer {{ $view == 'grid' ? 'text-greenLime-500' : '' }}" wire:click="$set('view', 'grid')"></i>
                <i class=" fas fa-th-list p-3 text-gray-500 cursor-pointer {{ $view == 'list' ? 'text-greenLime-500' : '' }}" wire:click="$set('view', 'list')"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
        <aside class="mr-6 hidden sm:block md:block lg:block">
            <h2 class="font-semibold text-center mb-2">Anuncio</h2>
            <figure class="">
                <img class="w-full object-cover object-center" 
                     src="{{ Storage::url('ban.jpg') }}" alt="">
            </figure>
        </aside>

        <div class="md:col-span-2 lg:col-span-4 mt-8">
            @if ($view=='grid')
                <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($products as $product)
                        <li class="bg-white rounded-md shadow-md">
                            <a href="{{ route('products.show', $product) }}">
                                <article>
                                    <figure>
                                        <img class="h-45 w-full object-cover object-center" src="{{ Storage::url($product->images->first()->url) }}" alt="">
                                    </figure>
                                    <div class="pt-4 px-5">
                                        <h1 class="text-lg font-semibold">
                                            <a href="{{ route('products.show', $product) }}">
                                                {{ Str::limit($product->name, 20, '...') }}
                                            </a>
                                        </h1>
                                        <p class="font-bold text-trueGray-500 pb-4">
                                            $ {{ $product->price }}
                                        </p>
                                    </div>
                                </article>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <ul>
                    @foreach ($products as $product)
                        <x-product-list :product="$product" />
                    @endforeach
                </ul>
            @endif
            
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
