@include('admin.layouts.header')
    <div class="content-body">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <form class="form form-horizontal form-bordered" method="get" action="{{route('packages_filter')}}">
                                <div class="form-body">
                                    <h4 class="form-section">Manage Packages</h4>
                                    <div class="row">
                                        <div class="col-md-3" id="filter_button">
                                            <input type="text" id="" value="" class="form-control" name="name" placeholder="Enter Name">
                                        </div>
                                        <div class="col-md-3" id="filter_button">
                                            <input type="text" id="" value="" class="form-control" name="price" placeholder="Enter Price">
                                        </div>
                                         <div class="col-md-3" id="filter_button">
                                            <input type="text" id="" value="" class="form-control" name="category" placeholder="Enter Category">
                                        </div>
                                        <div class="col-md-3 text-right">
                                            @if($total_records > 0)
                                            <h6>Total Records Found: {{$total_records}}</h6>
                                            @else
                                            <h6>Total Records Found: 0</h6>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <select class="form-control" name="status">
                                                <option value="0">Active</option>
                                                <option value="1">InActive</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button class="btn btn-outline-primary" type="submit">Filter</button>
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
                                            <th>Price</th>
                                            <th>Category</th>
	                                        <th>Status</th>
	                                        <th>Action</th>
	                                    </tr>
	                                </thead>
	                                <tbody>
                                        @if(!empty($total_records))
                                        @foreach($query as $row)
                                        <tr>
                                            <td>
                                                <img src="{{asset('public/assets/admin/images/packages/package')}}/{{$row->featured_image}}" height="70">
                                            </td>
		                                    <td>{{$row->name}}</td>
                                            <td>{{$row->package_price}}</td>
                                            <td>{{$row->category_name}}</td>
		                                    <td>
                                                <form method="post" id="package_form_status" action="{{route('update_packages_status',$row->id)}}">
                                                @csrf
                                                <input type="hidden" name="status" value="1">
                                                <input @if($row->status == 0) checked="checked" 
                                                @else @endif type="checkbox" name="status" id="switchery01" class="switchery package_status" value="0" data-target="{{route('update_packages_status',$row->id)}}" >
                                                </form>
                                            </td>
		                                    <td>
		                                    	<div role="group" class="btn-group">
												    <button id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-outline-primary dropdown-toggle dropdown-menu-right"><i class="ft-edit icon-left"></i> Action</button>
												    <div aria-labelledby="btnGroupDrop1" class="dropdown-menu">
												    	<a href="{{route('packages_edit',$row->id)}}" class="dropdown-item">Edit</a>
												    	<a href="{{route('packages_delete',$row->id)}}" data-toggle="modal"
                                                         data-target="#show" class="dropdown-item" id="delete_package">Delete</a>
												    </div>
												</div>
											</td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                           <td></td>
                                           <td></td>
                                           <td class="text-right">No Records Found</td>
                                           <td></td> 
                                        </tr>
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
            <div class="modal-body">
              <form method="post" action="" id="packages_delete_form">
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
</div>
@include('admin.layouts.footer')