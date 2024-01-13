<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class ShopComponent extends Component
{
    public $sorting;
    public $pagesize;
    public $min_price;
    public $max_price;

    public function mount()
    {
        $this->sorting = "default";
        $this->pagesize = 12;
        $this->min_price = 1;
        $this->max_price = 1000;
    }

    public function store($prod_id, $prod_name, $prod_price){
        Cart::add($prod_id, $prod_name, 1, $prod_price)->associate('App\Models\Product');
        session()->flash('message', 'Item added in Cart');
        return redirect()->route('product.cart');
    }

    use WithPagination;
    // protected $paginationTheme = 'bootstrap';
    public function render()
    {
        if ($this->sorting=='date') {
            $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('created_at','DESC')->paginate($this->pagesize);
        } else if($this->sorting=='price') {
            $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('regular_price','ASC')->paginate($this->pagesize);            
        } else if($this->sorting=='price-desc') {
            $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('regular_price','DESC')->paginate($this->pagesize);            
        } else {
            $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->paginate($this->pagesize);
        }

        $categories = Category::get();
        
        return view('livewire.shop-component',['products'=>$products,'categories'=>$categories])->layout('layouts.base');
    }
}