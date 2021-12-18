<x-app-layout>
    <div class="container py-8">
        <section class="mb-6">
            @foreach ($categories as $category)
                <div class="flex items-center mb-2">
                    <h1 class="text-lg uppercase font-semibold text-trueGray-700 mr-2">
                        {{ $category->name }}
                    </h1>

                    <a href="{{ route('categories.show', $category ) }}" 
                       class=" text-greenLime-500 font-semibold hover:text-greenLime-400 hover:underline">Ver más...</a>
                </div>
                @livewire('category-products', ['category' => $category])
            @endforeach
        </section>
    @push('script')
        <script>
            Livewire.on('glider', function(id){
                new Glider(document.querySelector('.glider-' + id), {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    draggable: true,
                    dots: '.glider-' + id + '~ .dots',
                    arrows: {
                        prev: '.glider-' + id + '~ .glider-prev',
                        next: '.glider-' + id + '~ .glider-next'
                    },
                    responsive: [
                        {
                            breakpoint: 640, 
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2,
                            }
                        },
                        {
                            breakpoint: 768, 
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 3,
                            }
                        },
                        {
                            breakpoint: 1024, 
                            settings: {
                                slidesToShow: 4,
                                slidesToScroll: 4,
                            }
                        },
                        {
                            breakpoint: 1280, 
                            settings: {
                                slidesToShow: 5,
                                slidesToScroll: 5,
                            }
                        },
                    ]
                });
            });
        </script>
    @endpush
</x-app-layout>