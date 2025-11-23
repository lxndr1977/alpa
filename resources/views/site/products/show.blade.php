{{-- resources/views/site/products.blade.php --}}

<x-layouts.site>
      {{-- Hero Section com Imagens e Detalhes --}}
      <section class="pt-12 pb-24 ">
         <div class="max-w-7xl xl:container mx-auto px-4 sm:px-6 lg:px-8 ">
            <div class="flex gap-12">
               @include('site.snipplets.product.images')
               @include('site.snipplets.product.details')
            </div>
         </div>
      </section>


      @include('site.snipplets.product.description')

      {{-- Blocos de Conteúdo Dinâmicos --}}
      @if($product->content_blocks)
         <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('site.snipplets.product.content-blocks.index')
         </section>
      @endif
</x-layouts.site>