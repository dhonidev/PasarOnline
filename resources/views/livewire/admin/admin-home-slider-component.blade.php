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
                            <div class="col-md-6">All Sliders</div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.sliders.add') }}" class="btn btn-success pull-right">Add New</a>
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
                                    <th>Title</th>
                                    <th>Subtitle</th>
                                    <th>Price</th>
                                    <th>Link</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sliders as $slid)
                                    <tr>
                                        <td>{{$slid->id}}</td>
                                        <td><img src="{{ asset('assets/images/sliders') }}/{{$slid->image}}" alt="" width="120"></td>
                                        <td>{{$slid->title}}</td>
                                        <td>{{$slid->subtitle}}</td>
                                        <td>{{$slid->price}}</td>
                                        <td>{{$slid->link}}</td>
                                        <td>{{$slid->status == 1 ? 'Active' : 'Inactive'}}</td>
                                        <td>{{$slid->created_at}}</td>
                                        <td>
                                            <a href="{{ route('admin.sliders.edit', ['slide_id'=>$slid->id]) }}"><i class="fa fa-edit fa-2x"></i></a>
                                            <a href="" wire:click.prevent="deleteSlider({{$slid->id}})" style="margin-left: 10px;"><i class="fa fa-times fa-2x text-danger"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    
                                @endforelse
                            </tbody>
                        </table>
                        {{$sliders->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
