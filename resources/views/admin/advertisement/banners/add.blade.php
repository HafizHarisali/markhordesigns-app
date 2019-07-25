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
                                        <h4 class="form-section">Add Banner</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label-control">Bannner Image</label><br>
                                                    <input type="file" id="single_image" name="banner_image" data-id="1" required="">
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
                                        <div class="row mt-2">
                                            <div class="col-md-10">
                                                <label class="label-control">Select Location</label>
                                                <select class="form-control select_2">
                                                    <option value="_header">header</option>
                                                    <option value="_center">center</option>
                                                    <option value="_bottom">bottom</option>
                                                    <option value="_sidebar">sidebar</option>
                                                </select>
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