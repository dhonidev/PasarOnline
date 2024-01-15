<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class CartComponent extends Component
{
    public function increaseQuantity($rowId){
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('cart-count-component','refreshComponent');
    }
    public function decreaseQuantity($rowId){
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('cart-count-component','refreshComponent');
    }
    public function destroy($rowId){
        Cart::instance('cart')->remove($rowId);
        session()->flash('message', 'Item has been removed');
        $this->emitTo('cart-count-component','refreshComponent');
    }
    public function destroyAll(){
        Cart::instance('cart')->destroy();
        session()->flash('message', 'All Items has been removed');
        $this->emitTo('cart-count-component','refreshComponent');
    }
    public function saveForLater($rowId){
        $item = Cart::instance('cart')->get($rowId);
        Cart::instance('cart')->remove($rowId);
        Cart::instance('saveForLater')->add($item->id, $item->name, 1 , $item->price)->associate('App\Models\Product');
        $this->emitTo('cart-count-component','refreshComponent');
        session()->flash('message', 'Items has been saved for later');
    }
    public function saveForLaterToCart($rowId){
        $item = Cart::instance('saveForLater')->get($rowId);
        Cart::instance('saveForLater')->remove($rowId);
        Cart::instance('cart')->add($item->id, $item->name, 1 , $item->price)->associate('App\Models\Product');
        $this->emitTo('cart-count-component','refreshComponent');
        session()->flash('message', 'Item has move from saved for later to cart');
    }
    public function deleteSaveForLater($rowId){
        Cart::instance('saveForLater')->remove($rowId);
        session()->flash('message', 'Item has been removed from save for later');
        $this->emitTo('cart-count-component','refreshComponent');
    }
    public function render()
    {
        return view('livewire.cart-component')->layout('layouts.base');
    }
}
