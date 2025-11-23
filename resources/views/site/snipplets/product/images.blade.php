<div class="w-1/2 flex flex-col overflow-hidden md:sticky md:top-10">
   @if ($product->getMedia('products')->isNotEmpty())
      
      <div class="gallery-container">
         {{-- Thumbnails DEVEM vir PRIMEIRO no HTML --}}
         <div class="swiper swiper-thumbnails">
            <div class="swiper-wrapper">
               @foreach ($product->getMedia('products') as $media)
                  <div class="swiper-slide">
                     <img src="{{ $media->getUrl('thumbnail') }}" 
                          srcset="{{ $media->getSrcset('thumbnail') }}"
                          alt="{{ $media->name }}" 
                          class="rounded-lg w-full aspect-square object-cover">
                  </div>
               @endforeach
            </div>
            <div class="swiper-button-prev-thumb"></div>
            <div class="swiper-button-next-thumb"></div>
         </div>

         {{-- Imagem principal vem DEPOIS --}}
         <div class="swiper mySwiper2">
            <div class="swiper-wrapper">
               @foreach ($product->getMedia('products') as $media)
                  <div class="swiper-slide">
                     <img src="{{ $media->getUrl('responsive') }}"
                        srcset="{{ $media->getSrcset('responsive') }}"
                        sizes="(max-width: 640px) 100vw, 640px"
                        data-src="{{ $media->getUrl('responsive') }}"
                        data-srcset="{{ $media->getSrcset('responsive') }}"
                        alt="{{ $media->name }}"
                        width="1280"
                        height="1280"
                        class="lazyload rounded-lg aspect-square w-full h-auto object-cover">
                  </div>
               @endforeach
            </div>
         </div>
      </div>
 
   @else
      <img src="{{ asset('images/placeholder-product.webp') }}" 
           alt="Imagem do produto" 
           class="rounded-lg w-full">
   @endif
</div>