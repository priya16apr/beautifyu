<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductRating extends Component
{
    public $product;
    public $label;

    public function __construct($product,$label)
    {
        $this->product = $product;
        $this->label   = $label;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-rating');
    }
}
