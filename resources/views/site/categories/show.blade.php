<x-layouts.site>

   @section('title', $category->meta_title ?? $category->name)

   <div class="max-w-6xl mx-auto px-4 py-10">
      <h1 class="text-3xl font-bold mb-6 text-neutral-800">
         {{ $category->name }}
      </h1>

      @if ($category->description)
         <p class="text-neutral-600 mb-8">{{ $category->description }}</p>
      @endif

      @if ($children->isEmpty())
         <p class="text-neutral-500">Nenhuma subcategoria encontrada.</p>
      @else
         <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($children as $child)
               <a href="{{ route('categories.show', $child->slug) }}"
                  class="block p-6 border border-neutral-200 rounded-lg hover:shadow-lg transition">

                  @if ($child->getMedia('categories')->isNotEmpty())
                     @php
                        $media = $child->getFirstMedia('categories');
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

                  <h2 class="text-xl font-semibold text-neutral-800 mb-2">{{ $child->name }}</h2>
                  @if ($child->description)
                     <p class="text-neutral-600 text-sm">{{ Str::limit($child->description, 100) }}</p>
                  @endif
               </a>
            @endforeach
         </div>
      @endif
   </div>
</x-layouts.site>
