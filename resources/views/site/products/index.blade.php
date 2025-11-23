<x-layouts.site>

   @if (isset($category))
      @section('title', $category->meta_title ?? $category->name)

      <div class="max-w-6xl mx-auto px-4 py-10">
         <h1 class="text-3xl font-bold mb-6 text-neutral-800">
            {{ $category->name }}
         </h1>

         @if ($category->description)
            <p class="text-neutral-600 mb-8">{{ $category->description }}</p>
         @endif
      </div>
   @else
      <x-site.breadcrumbs :items="[
          ['title' => 'Home', 'url' => route('home')],
          ['title' => 'Produtos', 'url' => route('products.index')],
          ['title' => 'Detalhes'],
      ]" />
   @endif

   <div class="max-w-6xl mx-auto px-4 py-10">
      <livewire:site.product-filter :category-id="$category->id ?? null" />
   </div>

</x-layouts.site>
