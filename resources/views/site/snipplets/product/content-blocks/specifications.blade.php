{{-- resources/views/site/snipplets/product/content-blocks/specifications.blade.php --}}
@php
   $specifications = $product->content_blocks['specifications']['sections'] ?? [];
@endphp

@if (!empty($specifications))
   <div class="specifications-block mb-12">
      <h2 class="text-2xl font-medium tracking-tighter text-sky-600 mb-6">Especificações Técnicas</h2>

      <div class="space-y-10">
         @foreach ($product->content_blocks['specifications']['sections'] as $section)
            <div class="section">
               <h3 class="text-lg font-medium mb-4 text-neutral-900 pb-2">
                  {{ $section['section_title'] }}
               </h3>

               <div class="bg-white rounded-lg overflow-hidden">
                  @foreach ($section['fields'] ?? [] as $field)
                     <div class="flex border-b border-neutral-200 first:border-t-1 hover:bg-neutral-50 transition-colors">
                        <div class="w-1/3 sm:w-1/4 text-neutral-700 p-4 ">
                           {{ $field['label'] }}
                        </div>
                        <div class="w-2/3 sm:w-3/4 text-neutral-900 font-medium p-4">
                           {{ $field['value'] }}
                        </div>
                     </div>
                  @endforeach
               </div>
            </div>
         @endforeach
      </div>
   </div>
@endif