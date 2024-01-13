<?php

namespace App\Http\Livewire\Admin;

use App\Models\Sale;
use Livewire\Component;

class AdminSaleComponent extends Component
{
    public $sale_date;
    public $sts;

    public function mount(){
        $sale = Sale::find(1);
        $this->sale_date = $sale->sale_date;
        $this->sts = $sale->sts;
    }
    public function updateSale(){
        $sale = Sale::find(1);
        $sale->sale_date = $this->sale_date;
        $sale->sts = $this->sts;
        $sale->save(); 
        session()->flash('message','Sale has been Updated successfully!'); 
    }
    public function render()
    {
        return view('livewire.admin.admin-sale-component')->layout('layouts.base');
    }
}
