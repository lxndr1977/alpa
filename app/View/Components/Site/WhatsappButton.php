<?php

namespace App\View\Components\Site;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WhatsappButton extends Component
{
   public $whatsappLink;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
        $this->whatsappLink = "https://wa.me/5551999833922?text=Ol%C3%A1!%20Gostaria%20de%20falar%20com%20um%20vendedor.";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.site.whatsapp-button');
    }
}
