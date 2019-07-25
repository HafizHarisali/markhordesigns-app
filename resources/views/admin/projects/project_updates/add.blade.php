@include('admin.layouts.header')
    <div class="content-body">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <form class="form form-horizontal form-bordered" action="" method="post" enctype="multipart/form-data" novalidate="">
                                    
                                    <div class="form-body">
                                        <h4 class="form-section">Add Project Updates</h4>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row controls">
                                                    <label class="label-control">Project Name</label>
                                                    <select class="form-control select_2">
                                                        <option>Ecommerce</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="label-control">Completed requirements</label>
                                                    <textarea id="completed_requirements" name="completed_requirements" class="form-control ckeditor" rows="5" placeholder="Completed Requirements"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="label-control">Pending requirements</label>
                                                    <textarea id="pending_requirements" name="pending_requirements" class="form-control ckeditor" rows="5" placeholder="Pending Requirements"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row last">
                                                    <label class="label-control">Package Status</label>
                                                    <select class="form-control select_2">
                                                        <option>Pending</option>
                                                        <option>Complete</option>
                                                        <option>Late</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions ml-2 mb-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-check-square-o"></i> Add
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@include('admin.layouts.footer')