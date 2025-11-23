<div>
   @if ($products->isEmpty())
      <p class="text-neutral-500">Nenhum produto encontrado.</p>
   @else
      @if ($layout === 'grid')
         {{-- ===== GRID ===== --}}
         <div class="grid gap-6 
            @if($columns === 1) grid-cols-1 
            @elseif($columns === 2) grid-cols-2 
            @elseif($columns === 3) grid-cols-3 
            @elseif($columns === 4) grid-cols-4 
            @elseif($columns === 5) grid-cols-5 
            @else grid-cols-3 @endif">
            
            @foreach ($products as $product)
               @include('site.snipplets.grid.product-card', ['product' => $product])
            @endforeach
         </div>

      @elseif ($layout === 'slide')
         {{-- ===== SWIPER SLIDER ===== --}}
         <div class="relative">
            <div class="swiper swiper-product">
               <div class="swiper-wrapper">
                  @foreach ($products as $product)
                     <div class="swiper-slide">
                        @include('site.snipplets.grid.product-card', ['product' => $product])
                     </div>
                  @endforeach
               </div>

               {{-- Setas --}}
               <div class="swiper-button-prev-product"></div>
               <div class="swiper-button-next-product"></div>
            </div>
         </div>
      @endif

      {{-- Paginação (somente se for paginator) --}}
      @if ($products instanceof \Illuminate\Contracts\Pagination\Paginator && $products->hasPages())
         <div class="mt-8">
            {{ $products->links() }}
         </div>
      @endif
   @endif
</div>
