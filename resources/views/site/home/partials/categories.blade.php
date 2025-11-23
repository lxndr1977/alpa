<section class="max-w-7xl mx-auto py-20 px-6 lg:px-8">
      <div class="flex items-center justify-between mb-8">
         <h2 class="text-2xl font-medium text-neutral-900">Categorias</h2>
      </div>

      <div class="relativ"> 
         <div class="swiper swiper-category relative overflow-visible"> 
            <div class="swiper-wrapper">
               @foreach ($categories as $category)
                  <div class="swiper-slide">
                     <a href="{{ url('categorias/' . $category->slug) }}"
                        class="block group border border-neutral-200 rounded-xl overflow-hidden bg-white hover:shadow-lg transition">

                        @php $media = $category->getFirstMedia('banner') ?? $category->getFirstMedia('image'); @endphp

                        @if ($media)
                           <img
                              src="{{ $media->getUrl('responsive') }}"
                              srcset="{{ $media->getSrcset('responsive') }}"
                              alt="{{ $category->name }}"
                              class="w-full aspect-[4/3] object-cover group-hover:scale-[1.03] transition-transform duration-500" />
                        @else
                           <img
                              src="{{ asset('images/placeholder-product.webp') }}"
                              alt="Sem imagem"
                              class="w-full aspect-[4/3] object-cover opacity-70" />
                        @endif

                        <div class="p-4 text-center">
                           <h3 class="text-lg font-semibold text-neutral-800">{{ $category->name }}</h3>
                        </div>
                     </a>
                  </div>
               @endforeach
            </div>

            {{-- Botões de navegação --}}
            <button
               class="swiper-button-prev-category absolute top-1/2 -translate-y-1/2 left-0 md:-left-10 z-10
                  w-10 h-10 flex items-center justify-center rounded-full 
                  bg-white/90 border border-neutral-300 shadow-md
                  text-neutral-600 hover:bg-neutral-100 hover:scale-105 transition">
               <x-lucide-chevron-left class="w-5 h-5" />
            </button>

            <button
               class="swiper-button-next-category absolute top-1/2 -translate-y-1/2 right-0 md:-right-10 z-10
                  w-10 h-10 flex items-center justify-center rounded-full 
                  bg-white/90 border border-neutral-300 shadow-md
                  text-neutral-600 hover:bg-neutral-100 hover:scale-105 transition">
               <x-lucide-chevron-right class="w-5 h-5" />
            </button>
         </div>
      </div>
   </section>