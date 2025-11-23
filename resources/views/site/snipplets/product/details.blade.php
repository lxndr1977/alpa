<div class="w-1/2 flex flex-col space-y-2 r">
    <x-site.breadcrumbs :items="[
          ['title' => 'Home', 'url' => route('home')],
          ['title' => 'Produtos', 'url' => route('products.index')],
          ['title' =>  $product->name ],
      ]" />

   <h1 class="text-3xl md:text-6xl font-medium text-sky-600 mb-3 tracking-tighter leading-tighter mb-4">
      {{ $product->name }}
   </h1>

   @if ($product->code) 
      <p class="text-stone-500 mb-12">Referência: {{ $product->code }}</p>
   @endif

   <p class="mb-6 text-xl text-stone-700">{{ $product->short_description }}</p>

   <div>
      <a href="#" class="inline-flex items-center gap-2 text-xl text-white bg-sky-600 hover:bg-sky-500 focus:ring-4 focus:ring-sky-300 font-medium rounded px-10 py-4 me-2 mb-2  focus:outline-none dark:focus:ring-sky-800">
         <x-lucide-file-text class="w-6 h-6"/>Solicite um orçamento
      </a>
   </div>

</div>
