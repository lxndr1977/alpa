{{-- resources/views/site/snipplets/product/content-blocks/faq.blade.php --}}
@php
    $faq = $product->content_blocks['faq']['questions'] ?? [];
@endphp

@if(!empty($faq))
<div class="faq-block">
   <h2 class="text-2xl font-medium tracking-tighter text-sky-600 mb-6">Perguntas Frequentes</h2>
   
   <div class="space-y-4">
      @foreach($faq as $item)
         <details class="bg-white rounded-lg border border-neutral-200 hover:border-sky-500 overflow-hidden group">
            <summary class="flex items-center justify-between p-6 cursor-pointer  transition-colors">
               <h3 class="text-lg font-medium text-neutral-900 pr-8 group-hover:text-sky-600 transition-colors">
                  {{ $item['question'] }}
               </h3>
               <svg class="w-5 h-5 text-neutral-500 transition-transform group-open:rotate-180 group-hover:text-sky-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
               </svg>
            </summary>
            
            <div class="px-6 pb-6 text-neutral-700 border-t border-neutral-100">
               <p class="pt-4 whitespace-pre-line">{{ $item['answer'] }}</p>
            </div>
         </details>
      @endforeach
   </div>
</div>
@endif