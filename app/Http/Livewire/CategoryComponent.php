<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class CategoryComponent extends Component
{
    public $sorting;
    public $pagesize;
    public $category_slug;

    public function mount($category_slug)
    {
        $this->sorting = "default";
        $this->pagesize = 12;                 
        $this->category_slug = $category_slug;                 
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
        $category = Category::where('slug', $this->category_slug)->first();

        if ($this->sorting=='date') {
            $products = Product::where('category_id', $category->id)->orderBy('created_at','DESC')->paginate($this->pagesize);
        } else if($this->sorting=='price') {
            $products = Product::where('category_id', $category->id)->orderBy('regular_price','ASC')->paginate($this->pagesize);            
        } else if($this->sorting=='price-desc') {
            $products = Product::where('category_id', $category->id)->orderBy('regular_price','DESC')->paginate($this->pagesize);            
        } else {
            $products = Product::where('category_id', $category->id)->paginate($this->pagesize);
        }

        $categories = Category::get();
        return view('livewire.category-component',['products'=>$products,'categories'=>$categories, 'category_name'=>$category->name])->layout('layouts.base');
    }
}
