@extends('admin.layouts.layout')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
<style>
    .dropzoneDragArea{
    border: 1px dashed #c0ccda;
    border-radius: 6px;
    padding: 60px;
    text-align: center;
    margin-bottom: 15px;
    cursor: pointer;

}

.dropzone333{
    box-shadow: 0px 2px 20px 0px #f2f2f2;
    border-radius: 10px;
}
</style>
@endsection
@section('body')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content" data-select2-id="select2-data-kt_content">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post" data-select2-id="select2-data-kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl" data-select2-id="select2-data-kt_content_container">
            <!--begin::Form-->
            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework " data-kt-redirect="" >
                @csrf
                @method('PUT')
                <!--begin::Aside column-->
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                    <!--begin::Thumbnail settings-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            @if($errors->any())
                            <div id="error-box">
                                <!-- Display errors here -->
                            </div>
                            @endif
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Thumbnail</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body text-center pt-0">
                            <!--begin::Image input-->
                            <div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true" style="">
                                <!--begin::Preview existing avatar-->
                                <div class="image-input-wrapper w-150px h-150px" style="background-image: url(../../../assets/media/stock/ecommerce/78.gif)"></div>
                                <!--end::Preview existing avatar-->
                                <!--begin::Label-->
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="Change avatar">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <!--begin::Inputs-->
                                    <input type="file" name="image" accept=".png, .jpg, .jpeg">
                                    <input type="hidden" name="image_remove">
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Label-->
                                <!--begin::Cancel-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="" data-bs-original-title="Cancel avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <!--end::Cancel-->
                                <!--begin::Remove-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="" data-bs-original-title="Remove avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <!--end::Remove-->
                            </div>
                            <!--end::Image input-->
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Set the product thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Thumbnail settings-->
                    <!--begin::Status-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Status</h2>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                @if($product->status != 'Unpublished')
                                <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_category_status"></div>
                                @else
                                <div class="rounded-circle bg-danger w-15px h-15px" id="kt_ecommerce_add_category_status"></div>

                                @endif
                            </div>
                            <!--begin::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Select2-->
                            <select class="form-select mb-2 select2-hidden-accessible" name="status" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_product_status_select" data-select2-id="select2-data-kt_ecommerce_add_product_status_select" tabindex="-1" aria-hidden="true">
                                <option>{{ $product->status }}</option>
                                <option value="published" selected="selected" data-select2-id="select2-data-11-cjyg">Published</option>

                                <option value="unpublished">Unpublished</option>
                            </select>
                            {{-- <span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-10-kbdx" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select mb-2" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-kt_ecommerce_add_product_status_select-container" aria-controls="select2-kt_ecommerce_add_product_status_select-container"><span class="select2-selection__rendered" id="select2-kt_ecommerce_add_product_status_select-container" role="textbox" aria-readonly="true" title="Published">Published</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> --}}
                            <!--end::Select2-->
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Set the product status.</div>
                            <!--end::Description-->
                            <!--begin::Datepicker-->
                            <div class="d-none mt-10">
                                <label for="kt_ecommerce_add_product_status_datepicker" class="form-label">Select publishing date and time</label>
                                <input class="form-control flatpickr-input" id="kt_ecommerce_add_product_status_datepicker" placeholder="Pick date &amp; time" type="text" readonly="readonly">
                            </div>
                            <!--end::Datepicker-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Status-->
                    <!--begin::Category & tags-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Product Details</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Input group-->
                            <!--begin::Label-->
                            <label class="form-label">Categories</label>
                            <!--end::Label-->
                            <!--begin::Select2-->
                            <select class="form-select mb-2 select2-hidden-accessible" name="category_id" id="category-select" data-control="select2" data-placeholder="{{ $product->category->name }}" data-allow-clear="true" multiple="" tabindex="-1" aria-hidden="true">
                                <option></option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" data-variations="{{ $category->variations }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>

                                @endforeach
                            </select>
                            {{-- <span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-13-d4q7" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple form-select mb-2" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered" id="select2-334k-container"></ul><span class="select2-search select2-search--inline"><textarea class="select2-search__field" type="search" tabindex="0" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" autocomplete="off" aria-label="Search" aria-describedby="select2-334k-container" placeholder="Select an option" style="width: 100%;"></textarea></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> --}}
                            <!--end::Select2-->
                            <!--begin::Description-->
                            <div class="text-muted fs-7 mb-7">Add product to a category.</div>
                            <!--end::Description-->
                            <!--end::Input group-->
                            <!--begin::Button-->
                            <a href="{{ route('category.create') }}" class="btn btn-light-primary btn-sm mb-10">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"></rect>
                                    <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"></rect>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->Create new category</a>
                            <!--end::Button-->

                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Category & tags-->

                </div>
                <!--end::Aside column-->
                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10" data-select2-id="select2-data-134-jjjz">
                    <!--begin:::Tabs-->

                    <!--end:::Tabs-->
                    <!--begin::Tab content-->
                    <div class="tab-content" data-select2-id="select2-data-133-ecro">
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade active show" id="kt_ecommerce_add_product_general" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <!--begin::General options-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>General</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="required form-label">Product Name</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="name" class="form-control mb-2" value="{{ $product->name }}" placeholder="Product name">
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">A product name is required and recommended to be unique.</div>
                                            <!--end::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <label class="form-label">Description</label>
                                        <textarea name="description" class="form-control" id="" cols="10" rows="5" placeholder="description">{{ $product->description }}</textarea>
                                        <br>

                                        <label class="form-label">Tags</label>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <input name='tags' value='{{ $product->tags }}' class="form-control p-2">
                                        {{-- <div>
                                            <!--begin::Label-->
                                            <label class="form-label">Description</label>
                                            <!--end::Label-->
                                            <!--begin::Editor-->
                                            <div class="ql-toolbar ql-snow"><span class="ql-formats"><span class="ql-header ql-picker"><span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-0"><svg viewBox="0 0 18 18"> <polygon class="ql-stroke" points="7 11 9 13 11 11 7 11"></polygon> <polygon class="ql-stroke" points="7 7 9 5 11 7 7 7"></polygon> </svg></span><span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-0"><span tabindex="0" role="button" class="ql-picker-item" data-value="1"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="2"></span><span tabindex="0" role="button" class="ql-picker-item ql-selected"></span></span></span><select class="ql-header" style="display: none;"><option value="1"></option><option value="2"></option><option selected="selected"></option></select></span><span class="ql-formats"><button type="button" class="ql-bold"><svg viewBox="0 0 18 18"> <path class="ql-stroke" d="M5,4H9.5A2.5,2.5,0,0,1,12,6.5v0A2.5,2.5,0,0,1,9.5,9H5A0,0,0,0,1,5,9V4A0,0,0,0,1,5,4Z"></path> <path class="ql-stroke" d="M5,9h5.5A2.5,2.5,0,0,1,13,11.5v0A2.5,2.5,0,0,1,10.5,14H5a0,0,0,0,1,0,0V9A0,0,0,0,1,5,9Z"></path> </svg></button><button type="button" class="ql-italic"><svg viewBox="0 0 18 18"> <line class="ql-stroke" x1="7" x2="13" y1="4" y2="4"></line> <line class="ql-stroke" x1="5" x2="11" y1="14" y2="14"></line> <line class="ql-stroke" x1="8" x2="10" y1="14" y2="4"></line> </svg></button><button type="button" class="ql-underline"><svg viewBox="0 0 18 18"> <path class="ql-stroke" d="M5,3V9a4.012,4.012,0,0,0,4,4H9a4.012,4.012,0,0,0,4-4V3"></path> <rect class="ql-fill" height="1" rx="0.5" ry="0.5" width="12" x="3" y="15"></rect> </svg></button></span><span class="ql-formats"><button type="button" class="ql-image"><svg viewBox="0 0 18 18"> <rect class="ql-stroke" height="10" width="12" x="3" y="4"></rect> <circle class="ql-fill" cx="6" cy="7" r="1"></circle> <polyline class="ql-even ql-fill" points="5 12 5 11 7 9 8 10 11 7 13 9 13 12 5 12"></polyline> </svg></button><button type="button" class="ql-code-block"><svg viewBox="0 0 18 18"> <polyline class="ql-even ql-stroke" points="5 7 3 9 5 11"></polyline> <polyline class="ql-even ql-stroke" points="13 7 15 9 13 11"></polyline> <line class="ql-stroke" x1="10" x2="8" y1="5" y2="13"></line> </svg></button></span></div><div id="kt_ecommerce_add_product_description" name="kt_ecommerce_add_product_description" class="min-h-200px mb-2 ql-container ql-snow"><div class="ql-editor ql-blank" data-gramm="false" contenteditable="true" data-placeholder="Type your text here..."><p><br></p></div><div class="ql-clipboard" contenteditable="true" tabindex="-1"></div><div class="ql-tooltip ql-hidden"><a class="ql-preview" rel="noopener noreferrer" target="_blank" href="about:blank"></a><input type="text" data-formula="e=mc^2" data-link="https://quilljs.com" data-video="Embed URL"><a class="ql-action"></a><a class="ql-remove"></a></div></div>
                                            <!--end::Editor-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">Set a description to the product for better visibility.</div>
                                            <!--end::Description-->
                                        </div> --}}
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::General options-->
                                <!--begin::Media-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Media</h2>
                                            {{-- @if (session()->has('uploaded_images'))
                                            @foreach (session()->get('uploaded_images') as $image)
                                                <img src="{{ asset($image) }}" class="form-control" height="200px" width="200px" alt="Uploaded Image">
                                            @endforeach
                                            @endif --}}
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-2 form-group">
                                            <!--begin::Dropzone-->
                                            <div class="dropzone" id="product-images-dropzone">
                                                @foreach($images as $image)
                                                {{-- <div class="image-container"> --}}
                                                    <img src="{{ asset('storage/products/'.$image) }}" class="my-img dz-preview dz-processing dz-image-preview dz-error dz-complete" style="height: 120px; width: 120px; object-fit:cover;" alt="">
                                                    <a class="btn btn-light btn-sm delete-image-btn" data-image="{{ $image }}" data-id="{{ $product->id }}">X</a>
                                                {{-- </div> --}}
                                                @endforeach

                                                <div class="dz-message">
                                                    Click & Drop New product images here.
                                                </div>
                                            </div>

                                            <!--end::Dropzone-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Set the product media gallery.</div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::Media-->

                                <!--begin::Inventory-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Inventory</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="mb-3 row fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <div style="width: 50%" class="mb-2">
                                            <label class="required form-label">Base Price</label>
                                            <input type="text" name="price" id="price" value="{{ $product->price }}" class="form-control mb-2" placeholder="Product price" >
                                            </div>

                                            <div style="width: 25%" class="mb-2">
                                            <label class="required form-label ">Discount %</label>
                                            <input type="text" name="discount" id="discount" value="{{ $product->discount }}" class="form-control mb-2" placeholder="Discount Percentage" >
                                            </div>
                                            <div style="width: 25%" class="mb-2">
                                            <label class="required form-label ">Discounted Price</label>
                                            <input type="text" id="discounted_price" value="{{ $product->discounted_price }}" name="discounted_price" readonly class="form-control mb-2" placeholder="Discounted Price" >
                                            </div>

                                            <div style="width: 50%">
                                            <label class="required form-label">SKU</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="sku" value="{{ $product->sku }}" class="form-control mb-2 " placeholder="SKU Number" >
                                            </div>
                                            <!--end::Input-->
                                            <div style="width: 50%">
                                            <label class="required form-label">Quantity</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                                <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control mb-2" placeholder="Add quantity">
                                            </div>
                                            <div style="width: 50%">
                                            <label class="required form-label">Coupon</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                                <input type="number" name="coupon" value="{{ $product->coupon }}" class="form-control mb-2" placeholder="Add coupon">
                                            </div>
                                        <div class="fv-plugins-message-container invalid-feedback"></div></div>

                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::Inventory-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Variations</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="" data-kt-ecommerce-catalog-add-product="auto-options">
                                            <!--begin::Label-->
                                            <label class="form-label">Add Product Variations</label>
                                            <!--end::Label-->
                                            <!--begin::Form group-->
                                            <div class="form-group">
                                                <!--begin::Select2-->
                                                <div class="row">
                                                    <div class="col-6">
                                                    <select class="form-select form-control select2" name="variation_type" id="variation-select" data-placeholder="Select an option" tabindex="-1" aria-hidden="true">
                                                        <option value="{{ $product->variation_type }}" {{ old('variation_type', $product->variation_type) == $product->variation_type ? 'selected' : '' }}>{{ $product->variation_type }}</option>

                                                    </select>

                                                    </div>
                                                    <!--end::Select2-->
                                                    <!--begin::Input-->
                                                    <div class="col-6">
                                                        <input name='variation' placeholder="Variation" value='{{ $product->variation }}' class="form-control p-2">
                                                        {{-- <input class="form-control col-6" name="variation" placeholder="Variation"> --}}
                                                    </div>
                                                </div>
                                                <!--end::Input-->

                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Card header-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Tab content-->
                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="products.html" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancel</a>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" id="kt_ecommerce_add_product_submit1" class="btn btn-primary">
                            <span class="indicator-label">Save Changes</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                </div>
                <!--end::Main column-->
            <div></div></form>
            <!--end::Form-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('.delete-image-btn').on('click', function () {
            var image = $(this).data('image');
            var id = $(this).data('id');

            $.ajax({
                url: '/delete-image',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    image: image,
                    id:id,
                },
                success: function (response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert('Failed to delete image');
                    }
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#price, #discount').on('input', function() {
            var price = parseFloat($('#price').val());
            var discount = parseInt($('#discount').val());

            if (!isNaN(price) && !isNaN(discount)) {
                var discountedPrice = price - (price * discount / 100);
                $('#discounted_price').val(discountedPrice.toFixed(2));
            }
        });
    });
</script>
<script>
    $(document).on('change', '#category-select', function() {
        let cid = $(this).val();
        $.ajax({
            url: "/variationType",
            method: 'POST',
            data: 'cid='+cid,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

            success:function(result) {
                $('#variation-select').html(result)
            }
        });
    });
</script>
<script>
    $(function () {
        Dropzone.autoDiscover = false;
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        var myDropzone = new Dropzone("#product-images-dropzone", {
            url: "{{ url('/upload') }}",
            headers: {
                'x-csrf-token': CSRF_TOKEN,
            },
            paramName: "file",
            maxFilesize: 2,
            acceptedFiles: ".jpg,.jpeg,.png,.gif",
            addRemoveLinks: true,
            init: function () {
                this.on("success", function (file, response) {
                    console.log(response);
                });

                this.on("removedfile", function (file) {
                    $.ajax({
                        url: "{{ url('/upload/remove') }}",
                        type: "POST",
                        data: {
                            filename: file.name,
                            _token: "{{ csrf_token() }}"
                        }
                    });
                });
            }
        });
    });
</script>
<script>
    Dropzone.autoDiscover = false;
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var myDropzone = new Dropzone("#product-images-dropzone1", {
        url: "/upload1",
        headers: {
            'x-csrf-token': CSRF_TOKEN,
        },
        paramName: "file",
        maxFiles: 2,
        acceptedFiles: ".jpg,.png,.gif",
        dictDefaultMessage: "Drop your files here or click to select"

    });
</script>

<script>
    $('.repeater').repeater();
</script>
<script>
var input = document.querySelector('input[name=variation]');

new Tagify(input)
</script>
<script>
var input = document.querySelector('input[name=tags]');

new Tagify(input)
</script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>

@endsection
