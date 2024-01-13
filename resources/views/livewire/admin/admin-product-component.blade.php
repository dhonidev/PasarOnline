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
                            <div class="col-md-6">All Products</div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.products.add') }}" class="btn btn-success pull-right">Add New</a>
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
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Sale Price</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $prod)
                                    <tr>
                                        <td>{{$prod->id}}</td>
                                        <td>
                                            <img src="{{ asset('assets/images/products') }}/{{$prod->image}}" alt="{{$prod->name}}" width="60">
                                        </td>
                                        <td>{{$prod->name}}</td>
                                        <td>{{$prod->stock_status}}</td>
                                        <td>{{$prod->regular_price}}</td>
                                        <td>{{$prod->sale_price}}</td>
                                        <td>{{$prod->category->name}}</td>
                                        <td>{{$prod->created_at}}</td>
                                        <td>
                                            <a href="{{ route('admin.products.edit', ['product_slug'=>$prod->slug]) }}"><i class="fa fa-edit fa-2x"></i></a>
                                            <a href="" onclick="confirm('Are you sure, You want to delete this category?') || event.stopImmediatePropagation()"  wire:click.prevent="deleteProduct({{$prod->id}})" style="margin-left: 10px;"><i class="fa fa-times fa-2x text-danger"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    
                                @endforelse
                            </tbody>
                        </table>
                        {{$products->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
