@include('admin.layouts.header')
    <div class="content-body">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <form class="form form-horizontal form-bordered">
                                    <div class="form-body">
                                        <h4 class="form-section">Manage Blogs</h4>
                                        <div class="row">
                                        	<div class="col-md-10">
                            		           Total  Records : 0
                                        	</div>
                                        	<div class="col-md-1">
                                        		<a href="#"><i class="ft-plus"></i> Add</a>
                                    		</div>
                                    		<div class="col-md-1" id="filter_button">
                                    			<a href="javascript::void(0);" id="add_filter"><i class="ft-filter"></i> Filter</a>
                                                <input type="hidden" id="search_url" value="#">
                                    		</div>
                                    	</div>
                                    	<div id="filter_section"></div>
                                    </div><br><br>
                                    <div class="table-responsive">          
  										<table class="table">
											<thead>
			                                    <tr>
                                                    <th>Image</th>
			                                        <th>Title</th>
			                                        <th>Status</th>
			                                        <th>Action</th>
			                                    </tr>
			                                </thead>
			                                <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="#">
                                                    </td>
				                                    <td>Web Design</td>
				                                    <td>
                                                        <span class="badge badge-default badge-success">Active</span>
                                                    </td>
				                                    <td>
				                                    	<div role="group" class="btn-group">
														    <button id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-outline-primary dropdown-toggle dropdown-menu-right"><i class="ft-edit icon-left"></i> Action</button>
														    <div aria-labelledby="btnGroupDrop1" class="dropdown-menu">
														    	<a href="#" class="dropdown-item">Edit</a>
														    	<a data-toggle="modal"
                                                                 data-target="#show" class="dropdown-item">Delete</a>
														    </div>
														</div>
													</td>
                                                </tr>
			                               	</tbody>
										</table>
									</div>
                                </form>
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
              <h5>This action cannot be undone</h5>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-outline-primary">Delete</button>
            </div>
          </div>
        </div>
    </div>
</div>
@include('admin.layouts.footer')