<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use Livewire\Component;
use Cart;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CartComponent extends Component
{
    public $hasCouponCode;
    public $couponCode;
    public $discount;
    public $subTotalAfterDiscount;
    public $taxAfterDiscount;
    public $totalAfterDiscount;

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
    public function rendemCoupon(){
        $coupon = Coupon::where('code',$this->couponCode)->where('expiry_date','>=', Carbon::today())->where('cart_value','<=', Cart::instance('cart')->subtotal())->first();
        if (!$coupon) {
            session()->flash('coupon_message', 'Coupon code is invalid');
            return;
        }
        session()->put('coupon',[
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'cart_value' => $coupon->cart_value
        ]);
    }
    public function calDiscount(){
        if (session()->has('coupon')) {
            if (session()->get('coupon')['type'] == 'fixed') {
                $this->discount = session()->get('coupon')['value'];
            } else {
                $this->discount = (Cart::instance('cart')->subtotal() *session()->get('coupon')['value'])/100;
            }
            $this->subTotalAfterDiscount = Cart::instance('cart')->subtotal()  - $this->discount;
            $this->taxAfterDiscount = ($this->subTotalAfterDiscount * config('cart.tax'))/100;
            $this->totalAfterDiscount = $this->subTotalAfterDiscount + $this->taxAfterDiscount;            
        }
    }
    public function removeCoupon(){
        session()->forget('coupon');
    }
    
    public function checkout(){
        if (Auth::check()) {
            return redirect()->route('checkout');
        } else {
            return redirect()->route('login');
        }
    }
    
    public function amountCheckout(){
        if (!Cart::instance('cart')->count() > 0) {
            session()->forget('checkout');
            return;
        }
        if (session()->has('coupon')) {
            session()->put('checkout',[
                'discount' => $this->discount,
                'subtotal' => $this->subTotalAfterDiscount,
                'tax' => $this->taxAfterDiscount,
                'total' => $this->totalAfterDiscount
            ]);
        } else {
            session()->put('checkout',[
                'discount' => 0,
                'subtotal' => Cart::instance('cart')->subtotal(),
                'tax' => Cart::instance('cart')->tax(),
                'total' => Cart::instance('cart')->total()
            ]);
        }
    }

    public function render()
    {
        if (session()->has('coupon')) {
            if (Cart::instance('cart')->subtotal() < session()->get('coupon')['cart_value']) {
                session()->forget('coupon');
            } else {
                $this->calDiscount();
            }
        }
        $this->amountCheckout();
        return view('livewire.cart-component')->layout('layouts.base');
    }
}
