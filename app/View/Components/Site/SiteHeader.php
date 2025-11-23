<?php

namespace App\View\Components\Site;

use App\Models\Segment;
use App\Models\Category;
use Illuminate\View\Component;

class SiteHeader extends Component
{
   public array $logo;
   public array $menuItems;
   public array $ctaButton;
   public int $scrollThreshold;

   public $categories;
   public $segments;


   public function __construct()
   {

      $this->logo = [
         'href' => '/',
         'src'  => '/images/logo.png',
         'alt'  => 'Logo da empresa',
      ];

      $this->menuItems = [
         [
            'label' => 'Empresa',
            'href'  => '/empresa',
         ],
         [
            'label' => 'Contato',
            'href'  => '/contato',
         ],
      ];

      $this->ctaButton = [
         'href' => 'https://wa.me/5541999999999',
         'text' => 'Fale Conosco',
      ];

      $this->scrollThreshold = 80;
      
      $this->categories = Category::whereNull('parent_category_id')
         ->active()
         ->with([
            'activeChildren' => fn($q) => $q->where('is_active', true)->orderBy('order'),
            'activeChildren.activeChildren' => fn($q) => $q->where('is_active', true)->orderBy('order'),
         ])
         ->orderBy('order')
         ->get();

      $this->segments = Segment::active()
         ->orderBy('name')
         ->get();
   }

   public function render()
   {
      return view('components.site.header');
   }
}
