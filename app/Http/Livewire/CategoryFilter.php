<?php

namespace App\Http\Livewire;

use BaconQrCode\Renderer\Color\Cmyk;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryFilter extends Component
{
    use WithPagination;

    public $category;
    public $view = "grid";

    public function render()
    {
        $products = $this->category->products()->where('status', 2)->paginate(12);
        return view('livewire.category-filter', compact('products'));
    }
}
