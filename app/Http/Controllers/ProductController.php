<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function index()
   {
      $products = Product::with('media')
         ->active()
         ->orderBy('name')->paginate(12);

      return view('site.products.index', compact('products'));
   }

   public function show(Product $product)
   {
      return view('site.products.show', compact('product'));
   }
}
