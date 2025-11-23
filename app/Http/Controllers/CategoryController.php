<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
   public function index()
   {
      $categories = Category::active()
         ->whereNull('parent_category_id')
         ->orderBy('name')
         ->get();

      return view('site.categories.index', compact('categories'));
   }

   public function show($slug)
   {
      $category = Category::active()
         ->where('slug', $slug)
         ->with([
            'activeChildren',           // apenas filhos ativos
            'activeChildren.activeChildren', // e netos ativos (se houver)
            'products'                  // produtos relacionados
         ])
         ->firstOrFail();

      if ($category->activeChildren->isNotEmpty()) {
         return view('site.categories.show', [
            'category' => $category,
            'children' => $category->activeChildren,
         ]);
      }

      $products = $category->products()
         ->when(
            $category->products()->getModel()->isFillable('is_active'),
            fn($q) => $q->where('is_active', true)
         )
         ->paginate(12);

      return view('site.products.index', [
         'category' => $category,
         'products' => $products,
      ]);
   }
}
