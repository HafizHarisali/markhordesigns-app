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
                                        <h4 class="form-section">Add Blog</h4>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row controls">
                                                    <label class="label-control">Title</label>
                                                    <input type="text" id="title" name="title" class="form-control" placeholder="Title" value="" required="" data-validation-required-message="This field is required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label-control">Blog Featured Image</label><br>
                                                    <input type="file" id="single_image" name="career_image" data-id="1" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row last">
                                                    <label class="label-control">Image Preview</label>
                                                    <div class="col-md-12">
                                                        <img class="single_image_preview_1" alt="Category Featured Image" style="width:150px; height:150px"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                 <div class="form-group">
                                                        <label class="label-control">Blog Details</label>
                                                        <textarea id="details" name="details" class="form-control ckeditor" rows="5" placeholder="Career Details"></textarea>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <label class="label-control">Meta Keywords</label>
                                                <input type="text" id="meta_keywords" name="meta_keywords" class="form-control" placeholder="Meta Keywords" value="">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="label-control">Meta Description</label>
                                                <input type="text" id="meta_description" name="meta_description" class="form-control" placeholder="Meta Description" value="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row last">
                                                    <label class="label-control">Blog Status</label>
                                                    <div class="input-group">
                                                        <label class="d-inline-block custom-control custom-radio ml-1">
                                                            <input type="radio" id="status" name="status" class="custom-control-input" value="0">
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description ml-0">Active</span>
                                                        </label>
                                                        <label class="d-inline-block custom-control custom-radio">
                                                            <input type="radio" id="status" name="status" class="custom-control-input" value="1">
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description ml-0">Inactive</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
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