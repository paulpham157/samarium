<?php

namespace App\Livewire\EcommWebsite;

use Livewire\Component;
use Illuminate\View\View;
use App\Product;

class ShoppingCartBadge extends Component
{
    public $total;

    protected $listeners = [
        'itemAddedToCart',
    ];

    public function render(): View
    {
        $total = 0;

        if (session('cart')) {
            $total = $this->getCartTotal();
        }

        $this->total = $total;

        return view('livewire.ecomm-website.shopping-cart-badge');
    }

    public function getCartTotal(): int|float
    {
        $total = 0;

        if (session('cart')) {
            foreach (session('cartItems') as $key => $val) {
                $product = Product::findOrFail($key);

                $total += $product->selling_price * $val;
            }
        }

        return $total;
    }

    public function itemAddedToCart()
    {
        session()->flash('yoho12', 'Cart updated');
    }
}
