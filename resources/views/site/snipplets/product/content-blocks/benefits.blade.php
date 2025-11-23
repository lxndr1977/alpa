{{-- resources/views/site/snipplets/product/content-blocks/benefits.blade.php --}}
@php
   $benefits = $product->content_blocks['benefits']['items'] ?? [];
@endphp

@if (!empty($benefits))
   <div class="benefits-block">
      <h2 class="text-2xl font-medium tracking-tighter text-sky-600 mb-6">Benefícios e Características</h2>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
         @foreach ($product->content_blocks['benefits']['items'] as $benefit)
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 hover:shadow-md transition-shadow">
               @if (!empty($benefit['icon']))
                  <div class="text-blue-600 mb-4">
                     {{-- Você pode usar Lucide icons ou outro sistema de ícones --}}
                     <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {{-- Ícone placeholder - substitua pelo sistema de ícones real --}}
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                     </svg>
                  </div>
               @endif

               <h3 class="text-xl font-semibold mb-2 text-gray-900">
                  {{ $benefit['title'] }}
               </h3>

               @if (!empty($benefit['description']))
                  <p class="text-gray-600">
                     {{ $benefit['description'] }}
                  </p>
               @endif
            </div>
         @endforeach
      </div>
   </div>
@endif
