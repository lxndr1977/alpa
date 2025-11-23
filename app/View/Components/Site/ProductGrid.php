<?php

namespace App\View\Components\Site;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductGrid extends Component
{
   public $products;
   public $layout; // grid ou slide
   public $columns; // 1 a 5 colunas

   /**
    * Create a new component instance.
    */
   public function __construct($products, $layout = 'grid', $columns = 3)
   {
      $this->products = $products;
      $this->layout = $layout;
      $this->columns = (int) $columns;
   }

   /**
    * Get the view / contents that represent the component.
    */
   public function render(): View|Closure|string
   {
      return view('components.site.product-grid', [
         'products' => $this->products,
         'layout' => $this->layout,
         'columns' => $this->columns,
      ]);
   }
}
