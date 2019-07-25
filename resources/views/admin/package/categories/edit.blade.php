@include('admin.layouts.header')
    <div class="content-body">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <form class="form form-horizontal form-bordered" action="{{route('package_categories_update',$data->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <h4 class="form-section">Edit Category</h4>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row controls">
                                                    <label class="label-control">Category Name</label>
                                                    <input type="text" id="name" name="name" class="form-control" placeholder="Category Name" value="{{$data->name}}" required="" data-validation-required-message="This field is required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label-control">Category Featured Image</label><br>
                                                    <input type="file" id="single_image" name="category_image" data-id="1" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row last">
                                                    <label class="label-control">Image Preview</label>
                                                    <div class="col-md-12">
                                                        <img class="single_image_preview_1" alt="Category Featured Image" src="{{asset('public/assets/admin/images/packages')}}/{{$data->featured_image}}" style="width:150px; height:150px"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <label class="label-control">Meta Keywords</label>
                                                <input type="text" id="meta_keywords" name="meta_keywords" class="form-control" placeholder="Meta Keywords" value="{{$data->meta_keywords}}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="label-control">Meta Description</label>
                                                <input type="text" id="meta_description" name="meta_description" class="form-control" placeholder="Meta Description" value="{{$data->meta_description}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row last">
                                                    <label class="label-control">Category Status</label>
                                                    <div class="input-group">
                                                        <label class="d-inline-block custom-control custom-radio ml-1">
                                                            <input type="radio" id="status" name="status" class="custom-control-input" value="0" @if($data->status == 0) checked="checked" @endif>
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description ml-0">Active</span>
                                                        </label>
                                                        <label class="d-inline-block custom-control custom-radio">
                                                            <input type="radio" id="status" name="status" class="custom-control-input" value="1" @if($data->status == 1) checked="checked" @endif>
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
                                            <i class="fa fa-check-square-o"></i> Update
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