@include('admin.layouts.header')
<div class="content-body">
    <section id="basic-form-layouts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <form class="form form-horizontal form-bordered" method="get" action="{{route('portfolio_categories_filter')}}">
                                <div class="form-body">
                                    <h4 class="form-section">Manage Portfolio Categories</h4>
                                    <div class="row">
                                        <div class="col-md-3" id="filter_button">
                                            <input type="text" id="search_url" value="" class="form-control" name="filter_name" placeholder="Enter Name">
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control" name="filter_status">
                                                <option value="0">Active</option>
                                                <option value="1">InActive</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button class="btn btn-outline-primary" type="submit">Filter</button>
                                        </div>
                                        <div class="col-md-3 text-right">
                                            @if($total_records > 0)
                                            <h6>Total Records Found: {{$total_records}}</h6>
                                            @else
                                            <h6>Total Records Found: 0</h6>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($total_records))
                                    @foreach($query as $row)
                                    <tr>
                                        <td>
                                            <img src="{{asset('public/assets/admin/images/portfolio/'.$row->featured_image)}}" height="70">
                                        </td>
                                        <td>{{$row->name}}</td>
                                        <td>
                                            <form method="post" id="formcheck" action="{{route('update_status',$row->id)}}">
                                                @csrf
                                            <input type="hidden" name="status" value="1">
                                            <input @if($row->status == 0) checked="checked" 
                                            @else @endif type="checkbox" name="status" id="switchery01" class="switchery" value="0" data-target="{{route('update_status',$row->id)}}" >
                                            </form>
                                        </td>
                                        <td>
                                            <div role="group" class="btn-group">
                                                <button id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-outline-primary dropdown-toggle dropdown-menu-right"><i class="ft-edit icon-left"></i> Action</button>
                                                <div aria-labelledby="btnGroupDrop1" class="dropdown-menu">
                                                    <a href="{{route('portfolio_categories_edit',$row->id)}}" class="dropdown-item">Edit</a>
                                                    <a href="{{route('portfolio_categories_delete',$row->id)}}" data-toggle="modal" id="delete_category" data-target="#show" class="dropdown-item">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr><td></td><td class="text-center">No Records Found</td><td></td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade text-left borderless" id="show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title" id="myModalLabel5">Are you sure?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="" id="form">
                @csrf
                <div class="modal-body">
                    <h5>This action cannot be undone</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-outline-primary">Delete</button>
                </div>         
            </form>
        </div>
    </div>
</div>
</div>
@include('admin.layouts.footer')