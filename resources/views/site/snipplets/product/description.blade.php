{{-- Descrição Geral (se existir) --}}
@if ($product->description)
   <section class="max-w-4xl mx-auto pt-24 pb-12 px-4 sm:px-6 lg:px-8">
      <h2 class="text-2xl font-medium tracking-tighter text-sky-600 mb-6">Sobre o Produto</h2>
      <div class="prose max-w-none space-y-6">
         {!! $product->description !!}
      </div>
   </section>
@endif
