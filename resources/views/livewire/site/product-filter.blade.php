<div>
    {{-- Breadcrumb de Categorias --}}
    @if($currentCategory)
        <div class="mb-4 text-sm text-gray-600 flex items-center flex-wrap gap-2">
            <a href="{{ url()->current() }}" 
               wire:click.prevent="$set('categoryId', null)"
               class="hover:text-blue-600 hover:underline">
                Todas as categorias
            </a>
            
            @if($currentCategory->level >= 2 && $currentCategory->parent)
                <span class="text-gray-400">/</span>
                <a href="{{ url()->current() }}?categoria={{ $currentCategory->parent->id }}" 
                   wire:click.prevent="$set('categoryId', {{ $currentCategory->parent->id }})"
                   class="hover:text-blue-600 hover:underline">
                    {{ $currentCategory->parent->name }}
                </a>
            @endif
            
            @if($currentCategory->level == 3 && $currentCategory->parent?->parent)
                <span class="text-gray-400">/</span>
                <a href="{{ url()->current() }}?categoria={{ $currentCategory->parent->parent->id }}" 
                   wire:click.prevent="$set('categoryId', {{ $currentCategory->parent->parent->id }})"
                   class="hover:text-blue-600 hover:underline">
                    {{ $currentCategory->parent->parent->name }}
                </a>
            @endif
            
            <span class="text-gray-400">/</span>
            <span class="font-semibold text-gray-800">{{ $currentCategory->name }}</span>
        </div>
    @endif

    {{-- Filtros --}}
    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Busca por nome --}}
            <div>
                <label for="search" class="block mb-2 text-sm font-medium text-gray-700">
                    Buscar produto:
                </label>
                <input 
                    id="search" 
                    type="text" 
                    wire:model="search"
                    class="w-full border border-gray-300 px-4 py-2 rounded focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Digite o nome do produto..."
                >
            </div>

            {{-- Lista de Categorias --}}
            @if($categories->isNotEmpty())
                <div class="lg:col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        {{ $currentCategory ? 'Subcategorias:' : 'Categorias:' }}
                    </label>
                    
                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                        {{-- Opção "Todas" --}}
                        @if($categoryId)
                            <a href="{{ url()->current() }}" 
                               wire:click.prevent="$set('categoryId', null)"
                               class="inline-block px-3 py-1.5 mb-2 mr-2 text-sm rounded-full border border-gray-300 hover:border-blue-500 hover:bg-blue-50 hover:text-blue-700 transition">
                                {{ $currentCategory ? '← Todas as subcategorias' : '← Todas as categorias' }}
                            </a>
                        @endif

                        {{-- Lista de categorias (primeiras 10) --}}
                        <div class="flex flex-wrap gap-2">
                            @foreach($categories->take(10) as $category)
                                <a href="{{ url()->current() }}?categoria={{ $category->id }}" 
                                   wire:click.prevent="$set('categoryId', {{ $category->id }})"
                                   class="inline-block px-4 py-2 text-sm rounded-lg border-2 
                                          {{ $categoryId == $category->id 
                                             ? 'border-blue-500 bg-blue-50 text-blue-700 font-medium' 
                                             : 'border-gray-200 hover:border-blue-400 hover:bg-blue-50 hover:text-blue-600' 
                                          }} transition">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>

                        {{-- Botão "Ver mais" se houver mais de 10 --}}
                        @if($categories->count() > 10)
                            <button 
                                wire:click="$toggle('showAllCategories')"
                                class="mt-3 text-sm text-blue-600 hover:text-blue-800 hover:underline font-medium"
                            >
                                @if($this->showAllCategories ?? false)
                                    ▲ Ver menos categorias
                                @else
                                    ▼ Ver mais {{ $categories->count() - 10 }} categorias
                                @endif
                            </button>

                            {{-- Categorias adicionais (depois da 10ª) --}}
                            @if($this->showAllCategories ?? false)
                                <div class="flex flex-wrap gap-2 mt-3 pt-3 border-t border-gray-200">
                                    @foreach($categories->slice(10) as $category)
                                        <a href="{{ url()->current() }}?categoria={{ $category->id }}" 
                                           wire:click.prevent="$set('categoryId', {{ $category->id }})"
                                           class="inline-block px-4 py-2 text-sm rounded-lg border-2 
                                                  {{ $categoryId == $category->id 
                                                     ? 'border-blue-500 bg-blue-50 text-blue-700 font-medium' 
                                                     : 'border-gray-200 hover:border-blue-400 hover:bg-blue-50 hover:text-blue-600' 
                                                  }} transition">
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            @endif
        </div>

        {{-- Botão Filtrar --}}
        <div class="mt-4">
            <button 
                wire:click="filter" 
                class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition font-medium"
            >
                 Filtrar
            </button>
        </div>
    </div>

    {{-- Badges de filtros ativos --}}
    @if($search || $currentCategory)
        <div class="mb-6 flex items-center gap-2 flex-wrap">
            <span class="text-sm text-gray-600 font-medium">Filtrando por:</span>
            
            @if($search)
                <span class="inline-flex items-center gap-2 bg-blue-100 text-blue-800 px-3 py-1.5 rounded-full text-sm">
                    <span>Busca: "{{ $search }}"</span>
                    <button 
                        wire:click="$set('search', '')"
                        class="hover:bg-blue-200 rounded-full p-0.5 transition"
                        title="Remover filtro"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </span>
            @endif
            
            @if($currentCategory)
                <span class="inline-flex items-center gap-2 bg-green-100 text-green-800 px-3 py-1.5 rounded-full text-sm">
                    <span>{{ $currentCategory->name }}</span>
                    <button 
                        wire:click="$set('categoryId', null)"
                        class="hover:bg-green-200 rounded-full p-0.5 transition"
                        title="Remover filtro"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </span>
            @endif

            {{-- Botão limpar todos --}}
            @if($search && $currentCategory)
                <button 
                    wire:click="clearFilters" 
                    class="text-sm text-gray-600 hover:text-gray-800 underline ml-2"
                >
                    Limpar todos os filtros
                </button>
            @endif
        </div>
    @endif

 {{-- Grid de Produtos --}}
    <x-site.product-grid :products="$products" />
</div>