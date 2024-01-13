<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class SearchComponent extends Component
{
    public $sorting;
    public $pagesize;
    public $search;
    public $product_cat;
    public $product_cat_id;

    public function mount()
    {
        $this->sorting = "default";
        $this->pagesize = 12;        
        $this->fill(request()->only('search','product_cat','product_cat_id'));         
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
        $query = Product::where('name', 'like', '%' . $this->search . '%');

        if ($this->product_cat_id) {
            // $query->where('category_id', 'like', '%' . $this->product_cat_id . '%');
            
            // $query->whereHas('category', function ($categoryQuery) {
            //     $categoryQuery->where('id', $this->product_cat_id);
            // });
        }

        switch ($this->sorting) {
            case 'date':
                $query->orderBy('created_at', 'DESC');
                break;
            case 'price':
                $query->orderBy('regular_price', 'ASC');
                break;
            case 'price-desc':
                $query->orderBy('regular_price', 'DESC');
                break;
        }

        $products = $query->paginate($this->pagesize);
        $categories = Category::get();
        
        return view('livewire.search-component',['products'=>$products,'categories'=>$categories])->layout('layouts.base');
    }
}
