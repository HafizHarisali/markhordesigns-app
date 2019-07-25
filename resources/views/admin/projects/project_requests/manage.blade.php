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
                                        <h4 class="form-section">Manage Project Requests</h4>
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
  			                                        <th>Request id</th>
  			                                        <th>User Name</th>
  			                                        <th>Package</th>
                                                <th>File</th>
                                                <th>Date / Time</th>
                                                <th>Status</th>
                                                <th>Actions</th>
  			                                    </tr>
  			                                </thead>
  			                                <tbody>
                                            <tr>
                                              <td>#10101</td>
                                              <td>Ali</td>
                                              <td>Silver</td>
                                              <td>
                                                  <button class="btn btn-info"><i class="fa fa-download"></i></button>
                                              </td>
                                              <td>March 18,2019 / 1:00 PM</td>
                                              <td>
                                                <span class="badge badge-default badge-success">Active</span>
                                              </td>
                                              <td>
                				                        <div role="group" class="btn-group">
                  														    <button id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-outline-primary dropdown-toggle dropdown-menu-right"><i class="ft-edit icon-left"></i> Action</button>
                  														    <div aria-labelledby="btnGroupDrop1" class="dropdown-menu">
                  														    	<a data-toggle="modal" data-target="#show" class="dropdown-item">Change Status</a>
                                                    <a href="#" class="dropdown-item">View Project</a>
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
              <h4 class="modal-title" id="myModalLabel5">Request Id : #10102</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <h5>Edit Status</h5>
              <div class="row">
                <div class="col-md-12">
                  <select class="form-control select_2">
                      <option>Pending</option>
                      <option>Approved</option>
                      <option>Denied</option>
                      <option>Delete</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-outline-primary">Update</button>
            </div>
          </div>
        </div>
    </div>
</div>
@include('admin.layouts.footer')