{{-- resources/views/site/snipplets/product/content-blocks/index.blade.php --}}

<div class="space-y-16">
   {{-- Benefícios e Características --}}
   @if(!empty($product->content_blocks['benefits']['items']))
      @include('site.snipplets.product.content-blocks.benefits')
   @endif

   {{-- Especificações Técnicas --}}
   @if(!empty($product->content_blocks['specifications']['sections']))
      @include('site.snipplets.product.content-blocks.specifications')
   @endif

   {{-- Documentação e Downloads --}}
   @if(!empty($product->content_blocks['downloads']['files']))
      @include('site.snipplets.product.content-blocks.downloads')
   @endif

   {{-- Perguntas Frequentes --}}
   @if(!empty($product->content_blocks['faq']['questions']))
      @include('site.snipplets.product.content-blocks.faq')
   @endif
</div>