<div wire:init="loadPosts">
    @if (count($products))
        <div class="glider-contain">
            <ul class="glider-{{ $category->id }}">
            @foreach ($products as $product)
                <li class="bg-white rounded shadow-md cursor-pointer {{ $loop->last?'':'sm:mr-5' }}">
                    <a href="{{ route('products.show', $product) }}">
                        <article>
                            <figure>
                                <img class="h-45 w-full object-cover object-center rounded-t" src="{{ Storage::url($product->images->first()->url) }}" alt="">
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
        
            <button aria-label="Previous" class="glider-prev">«</button>
            <button aria-label="Next" class="glider-next">»</button>
            <div role="tablist" class="dots" style="margin-top: 1rem;"></div>
        </div>
    @else
        <div class="mb-4 h-48 flex justify-center items-center bg-white shadow-xl border border-gray-100 rounded-lg">
            <div class="rounded animate-spin ease duration-300 w-10 h-10">
                <i class="fas fa-spinner text-greenLime-600 text-4xl"></i>
            </div>
        </div>		
    @endif
</div>