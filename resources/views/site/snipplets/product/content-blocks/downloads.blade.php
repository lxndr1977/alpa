{{-- resources/views/site/snipplets/product/content-blocks/downloads.blade.php --}}
@php
    $files = $product->content_blocks['downloads']['files'] ?? [];
@endphp

@if(!empty($files))

<div class="downloads-block">
   <h2 class="text-2xl font-medium tracking-tighter text-sky-600 mb-6">Arquivos para Download</h2>
   
   <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      @foreach($product->content_blocks['downloads']['files'] as $file)
         <a href="{{ Storage::url($file['file']) }}" 
            target="_blank"
            class="flex items-center bg-white rounded-lg p-6 border border-neutral-200 hover:border-sky-500 transition-all group">
            
            <div class="flex-1 min-w-0">
               <h3 class="text-lg font-medium text-neutral-900 group-hover:text-sky-600 transition-colors">
                  {{ $file['name'] }}
               </h3>
               
               @if(!empty($file['description']))
                  <p class="text-sm text-neutral-600 mt-2">
                     {{ $file['description'] }}
                  </p>
               @endif
            </div>
            
            <div class="flex-shrink-0 ml-4">
               <svg class="w-5 h-5 text-neutral-400 group-hover:text-sky-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
               </svg>
            </div>
         </a>
      @endforeach
   </div>
</div>
@endif