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
                            <div class="col-md-6">Manage Home Categories</div>
                            {{-- <div class="col-md-6">
                                <a href="{{ route('admin.categories.add') }}" class="btn btn-success pull-right">Add New</a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                        @endif
                        <form class="form-horizontal" wire:submit.prevent="updateHomeCategory">
                            <div class="form-group">
                                <label for="" class="col-md-4 control-label">Choose Categories</label>
                                <div class="col-md-4" wire:ignore>
                                    <select name="categories[]" id="" class="sel_categories" multiple="multiple" wire:model="selected_categories">
                                        @forelse ($categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @empty
                                            
                                        @endforelse
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="" class="col-md-4 control-label">No of Products</label>
                                <div class="col-md-4">
                                    <input type="text" name="" id="" class="form-control input-md" wire:model="numberofproducts">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" name="" id="" class="btn btn-primary">Save</button>
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
        $(document).ready(function(){
            $('.sel_categories').select2();
            $('.sel_categories').on('change',function(){
                var data = $('.sel_categories').select2('val');
                @this.set('selected_categories',data);
            })
        })
    </script>
@endpush