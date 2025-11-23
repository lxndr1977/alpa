<x-layouts.site>
   @section('title', 'Segmentos')
   <div class="max-w-6xl mx-auto px-4 py-10">
      @if ($segments->isNotEmpty())
         <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($segments as $segment)
               <a href="{{ route('segments.show', $segment->slug) }}"
                  class="block p-6 border border-neutral-200 rounded-lg hover:shadow-lg transition">

                  @if ($segment->getMedia('segments')->isNotEmpty())
                     @php
                        $media = $segment->getFirstMedia('segments');
                     @endphp

                     <div>
                        <img src="{{ $media->getUrl('responsive') }}"
                           srcset="{{ $media->getSrcset('responsive') }}"
                           sizes="(max-width: 640px) 100vw, 640px"
                           alt="{{ $media->name }}"
                           width="1280"
                           height="1280"
                           class="lazyload rounded-lg aspect-square w-full h-auto object-cover mb-6">
                     </div>
                  @else
                     <img src="{{ asset('images/placeholder-product.webp') }}"
                        alt="Imagem da categoria"
                        class="rounded-lg w-full mb-6">
                  @endif

                  <h2 class="text-xl font-semibold text-neutral-800 mb-2">{{ $segment->name }}</h2>
                  
                  @if ($segment->description)
                     <p class="text-neutral-600 text-sm">{{ Str::limit($segment->description, 100) }}</p>
                  @endif
               </a>
            @endforeach
         </div>
      @endif
   </div>
</x-layouts.site>
