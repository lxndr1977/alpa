{{-- resources/views/components/breadcrumbs.blade.php --}}
@props(['items' => []])

@if(count($items) > 0)
<nav aria-label="breadcrumb" class="mb-6">
    <ol class="flex flex-wrap items-center gap-2 px-4 py-3 text-sm bg-gray-50 rounded-lg">
        @foreach($items as $item)
            @if($loop->last)
                <li class="flex items-center text-gray-600 font-medium">
                    {{ $item['title'] }}
                </li>
            @else
                <li class="flex items-center gap-2">
                    <a 
                        href="{{ $item['url'] }}" 
                        class="text-blue-600 hover:text-blue-800 hover:underline transition-colors duration-200"
                    >
                        {{ $item['title'] }}
                    </a>
                    <svg 
                        class="w-4 h-4 text-gray-400" 
                        fill="none" 
                        stroke="currentColor" 
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
@endif