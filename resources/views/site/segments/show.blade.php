<x-layouts.site>

   @section('title', $segment->meta_title ?? $segment->name)

   <div class="max-w-6xl mx-auto px-4 py-10">
      <h1 class="text-3xl font-bold mb-6 text-neutral-800">
         {{ $segment->name }}
      </h1>

      @if ($segment->description)
         <p class="text-neutral-600 mb-8">{{ $segment->description }}</p>
      @endif

      @if ($segment->products->isEmpty())
         <p class="text-neutral-500">Nenhum produto encontrado neste segmento.</p>
      @endif


      AAAAAAAAAA
   </div>
</x-layouts.site>
