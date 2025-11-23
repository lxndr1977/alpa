<?php

namespace App\Http\Controllers;

use App\Models\Segment;

class SegmentController extends Controller
{

   public function index()
    {
        $segments = Segment::active()
            ->orderBy('name')
            ->get();

        return view('site.segments.index', compact('segments'));
    }
    
    public function show($slug)
    {
        $segment = Segment::active()
            ->where('slug', $slug)
            ->with(['products'])
            ->firstOrFail();

        // 🔸 Se o segmento tiver produtos, exibe products.blade.php
        $products = $segment->products()
            ->when(
                $segment->products()->getModel()->isFillable('is_active'),
                fn($q) => $q->where('products.is_active', true)
            )
            ->paginate(12);

        // Se o segmento não tiver produtos, apenas exibe a view de segmentos (descrição, etc)
        if ($products->isEmpty()) {
            return view('site.segments.show', [
                'segment' => $segment,
            ]);
        }

        // Reaproveita a mesma view de produtos das categorias
        return view('site.products', [
            'category' => $segment, // Mantém o mesmo nome de variável usado na view
            'products' => $products,
        ]);
    }
}
