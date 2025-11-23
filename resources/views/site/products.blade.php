<x-layouts.site>

@section('title', $category->meta_title ?? $category->name)

<div class="max-w-6xl mx-auto px-4 py-10">
   <h1 class="text-3xl font-bold mb-6 text-neutral-800">
      {{ $category->name }}
   </h1>

   @if($category->description)
      <p class="text-neutral-600 mb-8">{{ $category->description }}</p>
   @endif

   @if($products->isEmpty())
      <p class="text-neutral-500">Nenhum produto encontrado nesta categoria.</p>
   @else
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
         @foreach($products as $product)
            <div class="border border-neutral-200 rounded-lg p-4 hover:shadow-lg transition">
               <a href="{{ url('produtos/'.$product->slug) }}">
                  <img src="{{ $product->image_url ?? '/images/placeholder-product.webp' }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-md mb-4">
                  <h2 class="text-lg font-semibold text-neutral-800">{{ $product->name }}</h2>
                  @if($product->price)
                     <p class="text-primary-600 font-bold mt-2">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                  @endif
               </a>
            </div>
         @endforeach
      </div>

      <div class="mt-8">
         {{ $products->links() }}
      </div>
   @endif
</div>


</x-layouts.site>
