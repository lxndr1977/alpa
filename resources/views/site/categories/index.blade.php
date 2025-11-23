<x-layouts.site>
   <div class="max-w-6xl mx-auto px-4 py-10">
      @if ($categories->isNotEmpty())
         <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($categories as $category)
               <a href="{{ route('categories.show', $category->slug) }}"
                  class="block p-6 border border-neutral-200 rounded-lg hover:shadow-lg transition">

                  @if ($category->getMedia('categories')->isNotEmpty())
                     @php
                        $media = $category->getFirstMedia('categories');
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

                  <h2 class="text-xl font-semibold text-neutral-800 mb-2">{{ $category->name }}</h2>
                  
                  @if ($category->description)
                     <p class="text-neutral-600 text-sm">{{ Str::limit($category->description, 100) }}</p>
                  @endif
               </a>
            @endforeach
         </div>
      @endif
   </div>
</x-layouts.site>
