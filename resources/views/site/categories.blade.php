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
               <a href="{{ route('category.show', $child->slug) }}"
                  class="block p-6 border border-neutral-200 rounded-lg hover:shadow-lg transition">
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
