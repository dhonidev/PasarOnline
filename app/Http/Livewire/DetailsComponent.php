<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;
use Cart;

class DetailsComponent extends Component
{
    public $slug;
    public function mount($slug){
        $this->slug = $slug;
    }
    
    public function store($prod_id, $prod_name, $prod_price){
        Cart::add($prod_id, $prod_name, 1, $prod_price)->associate('App\Models\Product');
        session()->flash('message', 'Item added in Cart');
        return redirect()->route('product.cart');
    }
    public function render()
    {
        $product = Product::where('slug',$this->slug)->first();
        $pop_prods = Product::inRandomOrder()->limit(4)->get();
        $rel_prods = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(5)->get();
        $sale = Sale::find(1);
        return view('livewire.details-component',['product'=>$product,'pop_prods'=>$pop_prods,'rel_prods'=>$rel_prods,'sale'=>$sale])->layout('layouts.base');
    }
}
