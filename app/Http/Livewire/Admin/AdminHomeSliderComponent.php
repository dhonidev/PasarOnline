<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;
use Livewire\WithPagination;

class AdminHomeSliderComponent extends Component
{
    use WithPagination;
    
    public function deleteSlider($slide_id) {
        $slider = HomeSlider::find($slide_id); 
        $slider->delete(); 
        session()->flash('message','Slide has been deleted successfully!'); 
    }
    public function render()
    {
        $sliders = HomeSlider::paginate(10);
        return view('livewire.admin.admin-home-slider-component',['sliders'=>$sliders])->layout('layouts.base');
    }
}
