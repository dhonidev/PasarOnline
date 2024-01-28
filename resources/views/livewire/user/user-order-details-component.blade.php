<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('order_message'))
                    <div class="alert alert-success" role="alert">{{Session::get('order_message')}}</div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">Ordered Details</div>
                            <div class="col-md-6">
                                <a href="{{ route('user.orders') }}" class="btn btn-success pull-right">My Orders</a>
                                @if ($order->status == 'ordered')
                                    <a href="" wire:click.prvent="cancelOrder" style="margin-right: 20px" class="mr-2 btn btn-warning pull-right">Cancel</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>Order Id</th>
                                <td>{{$order->id}}</td>
                                <th>Order Date</th>
                                <td>{{$order->created_at}}</td>
                                <th>Status</th>
                                <td>{{$order->status}}</td>
                                @if ($order->status == 'delivered')
                                    <th>Delivery Date</th>
                                    <td>{{$order->delivered_date}}</td>
                                @elseif($order->status == 'canceled')
                                    <th>Cancel Date</th>
                                    <td>{{$order->canceled_date}}</td>
                                @endif
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Ordered Items
                    </div>
                    <div class="panel-body">
                        <div class="wrap-iten-in-cart">
                                <h3 class="box-title">Products Name</h3>
                                <ul class="products-cart">
                                    @forelse ($order->orderItems as $item)
                                        <li class="pr-cart-item">
                                            <div class="product-image">
                                                <figure><img src="{{asset('assets/images/products')}}/{{$item->product->image}}" alt="{{$item->product->name}}"></figure>
                                            </div>
                                            <div class="product-name">
                                                <a class="link-to-product" href="{{ route('product.details', ['slug'=>$item->product->slug]) }}">{{$item->product->name}}</a>
                                            </div>
                                            <div class="price-field produtc-price"><p class="price">${{$item->price}}</p></div>
                                            <div class="quantity">
                                                <h5>{{$item->quantity}}</h5>
                                            </div>
                                            <div class="price-field sub-total"><p class="price">${{$item->price * $item->quantity}}</p></div>
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                        </div>
                        <div class="summary">
                            <div class="order-summary">
                                <h4 class="title-box">Order Summary</h4>
                                <p class="summary-info"><span class="title">Subtotal</span><b class="index">${{$order->subtotal}}</b></p>
                                <p class="summary-info"><span class="title">Tax</span><b class="index">${{$order->tax}}</b></p>
                                <p class="summary-info"><span class="title">Shipping</span><b class="index">Free Shipping</b></p>
                                <p class="summary-info"><span class="title">Total</span><b class="index">${{$order->total}}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Billing Details</div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>First Name</th>
                                <th>{{$order->firstname}}</th>
                                <th>Last Name</th>
                                <th>{{$order->lastname}}</th>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <th>{{$order->phone}}</th>
                                <th>Email</th>
                                <th>{{$order->email}}</th>
                            </tr>
                            <tr>
                                <th>Lin1</th>
                                <th>{{$order->lin1}}</th>
                                <th>Line2</th>
                                <th>{{$order->line2}}</th>
                            </tr>
                            <tr>
                                <th>City</th>
                                <th>{{$order->city}}</th>
                                <th>Province</th>
                                <th>{{$order->province}}</th>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <th>{{$order->country}}</th>
                                <th>Zipcode</th>
                                <th>{{$order->zipcode}}</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if ($order->is_shipping_different)
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Shipping Details</div>
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <th>First Name</th>
                                    <th>{{$order->shipping->firstname}}</th>
                                    <th>Last Name</th>
                                    <th>{{$order->shipping->lastname}}</th>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <th>{{$order->shipping->phone}}</th>
                                    <th>Email</th>
                                    <th>{{$order->shipping->email}}</th>
                                </tr>
                                <tr>
                                    <th>Lin1</th>
                                    <th>{{$order->shipping->lin1}}</th>
                                    <th>Line2</th>
                                    <th>{{$order->shipping->line2}}</th>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <th>{{$order->shipping->city}}</th>
                                    <th>Province</th>
                                    <th>{{$order->shipping->province}}</th>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <th>{{$order->shipping->country}}</th>
                                    <th>Zipcode</th>
                                    <th>{{$order->shipping->zipcode}}</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Transaction  </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>Transaction Mode</th>
                                <th>{{$order->transaction->mode}}</th>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <th>{{$order->transaction->status}}</th>
                            </tr>
                            <tr>
                                <th>Transaction Date</th>
                                <th>{{$order->transaction->created_at}}</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
