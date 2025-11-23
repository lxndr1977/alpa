<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Segment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function show()
   {
      $products = Product::with('media')
         ->active()
         ->featured()
         ->limit(8)
         ->get();

      $categories = Category::active()
         ->featured()
         ->limit(5)
         ->get();

      $segments = Segment::active()
         ->featured()
         ->limit(5)
         ->get();

      return view('site.home.index', [
         'products' => $products,
         'categories' => $categories,
         'segments' => $segments,
      ]);
   }
}
