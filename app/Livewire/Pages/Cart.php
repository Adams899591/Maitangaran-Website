<?php

namespace App\Livewire\Pages;

use Illuminate\Http\Request;
use Livewire\Component;

class Cart extends Component
{

    public $imageId;
    public $productId;
    public $variantId;
    public $quantity;

    public function mount(Request $request)
    {
        // Read the parameters passed from the URL
        $this->imageId   = $request->query('id');
        $this->productId = $request->query('product_id');
        $this->variantId = $request->query('variant_id');
        $this->quantity  = $request->query('quantity', 1);

        // If data was passed, add it to session or database cart logic here
        // if ($this->productId) {
        //     $this->processAddToCart();
        // }
    }


    public function render()
    {
        return view('livewire.pages.cart')->layout("layouts.pages.app");
    }
}
