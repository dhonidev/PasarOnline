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
                            <div class="col-md-6">Add New Slider</div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.sliders') }}" class="btn btn-success">All Sliders</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success">{{Session::get('message')}}</div>
                        @endif
                        <form action="" class="form-horizontal" enctype="multipart/form-data" wire:submit.prevent="storeSlider">
                            <div class="form-group">
                                <div class="col-md-4 control-label">Title</div>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Title" class="form-control input-md" wire:model="title">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 control-label">Subtitle</div>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Subtitle" class="form-control input-md" wire:model="subtitle">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 control-label">Price</div>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Price" class="form-control input-md" wire:model="price">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 control-label">Link</div>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Link" class="form-control input-md" wire:model="link">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 control-label">Image</div>
                                <div class="col-md-4">
                                    <input type="file" placeholder="Image" class="input-file" wire:model="image">
                                    @if ($image)
                                        <img src="{{$image->temporaryUrl()}}" alt="" width="120"/>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 control-label">Status</div>
                                <div class="col-md-4">
                                    <select name="status" id="status" class="form-control" wire:model="status">
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>
                                    </select>
                                </div>
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
