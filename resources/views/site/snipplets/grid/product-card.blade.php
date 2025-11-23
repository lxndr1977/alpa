<div class="border border-neutral-200 rounded-lg p-4 hover:shadow-lg transition bg-white">
   <a href="{{ url('produtos/' . $product->slug) }}">
      @php $media = $product->getFirstMedia('gallery'); @endphp
      @if ($media)
         <img
            src="{{ $media->getUrl('responsive') }}"
            srcset="{{ $media->getSrcset('responsive') }}"
            sizes="(max-width: 640px) 100vw, 640px"
            alt="{{ $media->name ?? $product->name }}"
            width="1280"
            height="1280"
            class="rounded-lg aspect-square w-full h-auto object-cover">
      @else
         <img
            src="{{ asset('images/placeholder-product.webp') }}"
            alt="Sem imagem"
            class="rounded-lg aspect-square w-full h-auto object-cover opacity-70">
      @endif

      <h2 class="text-lg font-semibold text-neutral-800 mt-2 text-center">
         {{ $product->name }}
      </h2>
   </a>
</div>
