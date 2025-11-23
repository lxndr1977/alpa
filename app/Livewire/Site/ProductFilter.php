<?php

namespace App\Livewire\Site;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;

class ProductFilter extends Component
{
    use WithPagination;

    public string $search = '';
    public ?int $categoryId = null;
    public bool $showAllCategories = false; // NOVA PROPRIEDADE

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryId' => ['except' => null, 'as' => 'categoria']
    ]; 

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryId()
    {
        $this->resetPage();
                $this->showAllCategories = false; // Reseta ao trocar de categoria

    }

    public function filter()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->categoryId = null;
        $this->resetPage();
    }

    public function mount($categoryId = null)
{
    // Define a categoria inicial se vier da view Blade
    if ($categoryId) {
        $this->categoryId = (int) $categoryId;
    }
}


    public function render()
    {
        // Buscar produtos
        $products = Product::active()
            ->with(['media' => fn($q) => $q->where('collection_name', 'gallery')])
            ->when($this->search, fn($q) =>
                $q->where('name', 'like', '%' . $this->search . '%')
            )
            ->when($this->categoryId, function($q) {
                // Buscar categoria atual
                $category = Category::find($this->categoryId);
                
                if ($category) {
                    // IDs para filtrar (categoria atual + descendentes)
                    $categoryIds = [$category->id];
                    
                    // Se for nível 1, incluir níveis 2 e 3
                    if ($category->level == 1) {
                        $children = $category->activeChildren()->pluck('id');
                        $categoryIds = array_merge($categoryIds, $children->toArray());
                        
                        // Incluir netos (nível 3)
                        $grandchildren = Category::active()
                            ->whereIn('parent_category_id', $children)
                            ->pluck('id');
                        $categoryIds = array_merge($categoryIds, $grandchildren->toArray());
                    }
                    // Se for nível 2, incluir nível 3
                    elseif ($category->level == 2) {
                        $children = $category->activeChildren()->pluck('id');
                        $categoryIds = array_merge($categoryIds, $children->toArray());
                    }
                    
                    $q->whereHas('categories', fn($q) => $q->whereIn('categories.id', $categoryIds));
                }
            })
            ->orderBy('name')
            ->paginate(12);

        // Buscar categorias para o filtro
        $categories = $this->getFilterCategories();

        // Categoria atual (para breadcrumb)
        $currentCategory = $this->categoryId 
            ? Category::with(['parent.parent'])->find($this->categoryId) 
            : null;

        return view('livewire.site.product-filter', [
            'products' => $products,
            'categories' => $categories,
            'currentCategory' => $currentCategory,
        ]);
    }

    /**
     * Retorna as categorias corretas baseado no filtro atual
     */
    private function getFilterCategories()
    {
        // Se não há categoria selecionada, mostra as raízes (nível 1)
        if (!$this->categoryId) {
            return Category::active()
                ->whereNull('parent_category_id')
                ->orderBy('order')
                ->orderBy('name')
                ->get();
        }

        // Buscar categoria atual
        $category = Category::find($this->categoryId);
        
        if (!$category) {
            return collect();
        }

        // Se for nível 3, não tem filhos - retorna vazio ou irmãos
        if ($category->level == 3) {
            return collect(); // ou retornar irmãos se preferir
        }

        // Retorna filhos ativos da categoria atual
        return $category->activeChildren;
    }
}