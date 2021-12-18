<x-app-layout>
    <div class="container pt-9">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8">
            {{-- Sección de imagenes --}}
            <div>
                <div class="flexslider shadow-xl">
                    <ul class="slides">
                      @foreach ($product->images as $image)
                      <li data-thumb="{{ Storage::url($image->url) }}">
                        <img src="{{ Storage::url($image->url) }}" />
                      </li>
                      @endforeach
                    </ul>
                </div>
            </div>
            {{-- Sección de compra y detalles --}}
            <div>
                <h1 class="text-3xl text-trueGray-700 -mt-10 md:mt-0 font-bold">{{ $product->name }}</h1>
                <div class="flex">
                    {{-- <p class="text-trueGray-700"> 
                        <i class="fas fa-star text-sm text-yellow-400 "></i>
                        <i class="fas fa-star text-sm text-yellow-400 "></i>
                        <i class="fas fa-star text-sm text-yellow-400 "></i>
                        <i class="fas fa-star text-sm text-yellow-400 "></i>
                        <i class="fas fa-star text-sm text-yellow-400 "></i>
                    </p>
                    <p class="mx-3 font-bold">·</p>
                    <a class="text-greenLime-500 underline hover:text-greenLime-400" href="">19 Reseñas</a> --}}
                    <p class="text-trueGray-700">
                        Vendido por
                    </p>  
                    <p class="mx-1 font-bold">:</p>
                    <a class="text-greenLime-500 underline">
                        {{ $product->seller }}
                    </a>
                </div>
                <p class="text-2xl font-semibold my-4 text-trueGray-700">$ {{ $product->price }}</p>
                {{-- Descripcion --}}
                <div class="text-gray-700">
                    <h2 class="font-bold text-lg">Descripción</h2>
                    {!!$product->description!!}
                </div>
                {{-- Anuncio de envío --}}
                <div class="bg-white rounded-lg shadow-lg mb-6 mt-4">
                    <div class="p-4 flex items-center">
                        <span class="flex items-center justify-center h-10 w-10 rounded-full bg-greenLime-500">
                            <i class="fas fa-truck text-sm text-white"></i>
                        </span>
                        <div class="ml-4">
                            <p class="text-lg font-semibold text-greenLime-600">¡Se hacen envíos a todo México!</p>
                            <p class="font-semibold text-trueGray-700">Recibelo antes del <span class="capitalize">{{ Date::now()->addDay(3)->locale('es')->format('l j F') }}</span></p>
                        </div>
                    </div>
                </div>
                
                @livewire('add-cart-item', ['product' => $product])

            </div>
        </div>
    </div>
    @push('script')
        <script>
            $(document).ready(function() {
                $('.flexslider').flexslider({
                    animation: "slide",
                    controlNav: "thumbnails"
                });
            });
        </script>
    @endpush
</x-app-layout>