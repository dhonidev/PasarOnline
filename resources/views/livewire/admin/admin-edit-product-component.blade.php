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
                            <div class="col-md-6">Edit Product</div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.products') }}" class="btn btn-success">All Products</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success">{{Session::get('message')}}</div>
                        @endif
                        <form action="" class="form-horizontal" enctype="multipart/form-data" wire:submit.prevent="updateProduct">
                            <div class="form-group">
                                <div class="col-md-4 control-label">Product Name</div>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Product Name" class="form-control input-md" wire:model="name" wire:keyup="generateSlug">
                                </div>
                                @error('name')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 control-label">Product Slug</div>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Product Slug" class="form-control input-md" wire:model="slug" wire:keyup="generateSlug">
                                </div>
                                @error('slug')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 control-label">Short Description</div>
                                <div class="col-md-4" wire:ignore>
                                    <textarea name="short_description" id="short_description" cols="49" rows="3" placeholder="Short Description" wire:model="short_description"></textarea>
                                </div>
                                @error('short_description')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 control-label">Description</div>
                                <div class="col-md-4" wire:ignore>
                                    <textarea name="description" id="description" cols="49" rows="6" placeholder="Description" wire:model="description"></textarea>
                                </div>
                                @error('description')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 control-label">Regular Price</div>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Regular Price" class="form-control input-md" wire:model="regular_price">
                                </div>
                                @error('regular_price')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 control-label">Sale Price</div>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Sale Price" class="form-control input-md" wire:model="sale_price">
                                </div>
                                @error('sale_price')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 control-label">SKU</div>
                                <div class="col-md-4">
                                    <input type="text" placeholder="SKU" class="form-control input-md" wire:model="SKU">
                                </div>
                                @error('SKU')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 control-label">Stock</div>
                                <div class="col-md-4">
                                    <select name="stock_status" id="stock_status" class="form-control" wire:model="stock_status">
                                        <option value="instock">InStock</option>
                                        <option value="outofstock">Out of Stock</option>
                                    </select>
                                </div>
                                @error('stock_status')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 control-label">Featured</div>
                                <div class="col-md-4">
                                    <select name="featured" id="featured" class="form-control" wire:model="featured">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                                @error('featured')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 control-label">Quantity</div>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Quantity" class="form-control input-md" wire:model="quantity">
                                </div>
                                @error('quantity')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 control-label">Product Image</div>
                                <div class="col-md-4">
                                    <input type="file" placeholder="Product Image" class="input-file" wire:model="newImage">
                                    @if ($newImage)
                                        <img src="{{$newImage->temporaryUrl()}}" alt="" width="120"/>
                                    @else
                                        <img src="{{ asset('assets/images/products') }}/{{$image}}" alt="" width="120"/>
                                    @endif
                                </div>
                                @error('newImage')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 control-label">Category</div>
                                <div class="col-md-4">
                                    <select name="category_id" id="category_id" class="form-control" wire:model="category_id">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>                                            
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 control-label"></div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    $(function(){
        tinymce.init({
              selector: '#short_description',
              setup:function(editor){
                  editor.on('Change',function(e){
                      tinyMCE.triggerSave();
                      var sd_data = $('#short_description').val();
                      @this.set('short_description', sd_data);
                  })
              }
          });
        tinymce.init({
              selector: '#description',
              setup:function(editor){
                  editor.on('Change',function(e){
                      tinyMCE.triggerSave();
                      var sd_data = $('#description').val();
                      @this.set('description', sd_data);
                  })
              }
          });
    })
</script>
@endpush