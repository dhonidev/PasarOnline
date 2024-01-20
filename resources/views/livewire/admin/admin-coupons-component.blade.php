<div>
    <style>
        nav svg{
            height: 20px;
        }
        nav .hidden{
            display: block !important;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">All Coupons</div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.coupons.add') }}" class="btn btn-success pull-right">Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Coupon Code</th>
                                    <th>Coupon Type</th>
                                    <th>Coupon Value</th>
                                    <th>Cart Value</th>
                                    <th>Expire Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($coupons as $cop)
                                    <tr>
                                        <td>{{$cop->id}}</td>
                                        <td>{{$cop->code}}</td>
                                        <td>{{$cop->type}}</td>
                                        @if ($cop->type == 'fixed')
                                            <td>{{$cop->value}}</td>
                                        @else
                                            <td>{{$cop->value}} %</td>
                                        @endif
                                        <td>{{$cop->cart_value}}</td>
                                        <td>{{$cop->expiry_date}}</td>
                                        <td>
                                            <a href="{{ route('admin.coupons.edit', ['coupon_id'=>$cop->id]) }}"><i class="fa fa-edit fa-2x"></i></a>
                                            <a href="" onclick="confirm('Are you sure, You want to delete this coupon?') || event.stopImmediatePropagation()" wire:click.prevent="deleteCoupon({{$cop->id}})" style="margin-left: 10px;"><i class="fa fa-times fa-2x text-danger"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    
                                @endforelse
                            </tbody>
                        </table>
                        {{$coupons->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
