@include('admin.layouts.header')
    <div class="content-body">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <form class="form form-horizontal form-bordered" action="{{route('packages_insert')}}" method="post" enctype="multipart/form-data" novalidate="">
                                    @csrf
                                    <div class="form-body">
                                        <h4 class="form-section">Add Package</h4>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row controls">
                                                    <label class="label-control">Select Category *</label>
                                                    <select class="form-control select_2" name="category_id" required="">
                                                        @if(!empty($total_categories > 0))
                                                        <option>No Category Selected</option>
                                                        @foreach($query as $row)
                                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                                        @endforeach
                                                        @else
                                                        <option>No category found</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row controls">
                                                    <label class="label-control">Package Name *</label>
                                                    <input type="text" id="package_title" name="title" class="form-control" placeholder="Title" value="" required="" data-validation-required-message="This field is required">
                                                    <div class="error_message"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label-control">Featured Image *</label><br>
                                                    <input type="file" id="single_image" name="package_image" data-id="1" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row last">
                                                    <label class="label-control">Image Preview</label>
                                                    <div class="col-md-12">
                                                        <img class="single_image_preview_1" alt="Package Featured Image" style="width:150px; height:150px"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label-control">Gallery Images </label><br>
                                                    <input type="file" id="file-input" name="package_images[]" data-id="1" required="" multiple="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row last">
                                                    <label class="label-control">Images Preview</label>
                                                    <div class="col-md-12">
                                                        <div id="preview"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="label-control">Package Price *</label>
                                                    <input type="text" id="title" name="price" class="form-control" placeholder="Package Price" value="" required="" data-validation-required-message="This field is required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12" id="items">
                                                <div class="form-group">
                                                    <label>Package Offer *</label>
                                                    <input id="offer" class="form-control" name="package_offer[]" required="required" type="text"/>
                                                </div>
                                            </div><button type="button" class="add_field_button btn btn-info mt-1 ml-2">Add New Offer</button>
                                        </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="label-control">Package Details</label>
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