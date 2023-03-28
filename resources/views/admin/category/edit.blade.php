
@extends('admin.layouts.layout')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endsection
@section('body')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <form id="kt_ecommerce_add_category_form" method="POST" action="{{ route('category.update', $category->id) }}" enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework" data-kt-redirect="categories.html">
                <!--begin::Aside column-->
                @csrf
                @method('PUT')
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                    <!--begin::Thumbnail settings-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
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
                            <div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true" style="background-image: url(../../../assets/media/svg/files/blank-image.svg)">
                                <!--begin::Preview existing avatar-->
                                <div class="image-input-wrapper w-150px h-150px"></div>
                                <!--end::Preview existing avatar-->
                                <!--begin::Label-->
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="Change avatar">
                                    <!--begin::Icon-->
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <!--end::Icon-->
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
                            <div class="text-muted fs-7">Set the category thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
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
                                @if($category->status != 'Unpublished')
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
                            <select class="form-select mb-2 select2-hidden-accessible" name="status" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_category_status_select" data-select2-id="select2-data-kt_ecommerce_add_category_status_select" tabindex="-1" aria-hidden="true">
                                <option>{{ $category->status }}</option>
                                <option value="published" data-select2-id="select2-data-11-cjyg">Published</option>
                                <option value="unpublished">Unpublished</option>
                            </select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-10-f8bu" style="width: 100%;">
                                <span class="selection">
                                <span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span>
                                <span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            <!--end::Select2-->
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Set the category status.</div>
                            <!--end::Description-->
                            <!--begin::Datepicker-->
                            <div class="d-none mt-10">
                                <label for="kt_ecommerce_add_category_status_datepicker" class="form-label">Select publishing date and time</label>
                                <input class="form-control flatpickr-input" id="kt_ecommerce_add_category_status_datepicker" placeholder="Pick date &amp; time" type="hidden" readonly="readonly"><input class="form-control flatpickr-input flatpickr-mobile" tabindex="1" type="datetime-local" placeholder="Pick date &amp; time">
                            </div>
                            <!--end::Datepicker-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Status-->

                </div>
                <!--end::Aside column-->
                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
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
                                <label class="required form-label">Category Name</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="name" class="form-control mb-2" placeholder="Category name" value="{{ old('name', $category->name) }}">
                                <!--end::Input-->
                                <!--begin::Description-->
                                <div class="text-muted fs-7">A category name is required and recommended to be unique.</div>
                                <!--end::Description-->
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" id="" cols="10" rows="5">{{ old('description', $category->description) }}</textarea>
                            {{-- <div>
                                <!--begin::Label-->
                                <!--end::Label-->
                                <!--begin::Editor-->
                                <div class="ql-toolbar ql-snow">
                                    <span class="ql-formats"><span class="ql-header ql-picker">
                                        <span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-0">
                                            <svg viewBox="0 0 18 18">
                                                <polygon class="ql-stroke" points="7 11 9 13 11 11 7 11"></polygon>
                                                <polygon class="ql-stroke" points="7 7 9 5 11 7 7 7"></polygon>
                                            </svg>
                                        </span>
                                        <span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-0"><span tabindex="0" role="button" class="ql-picker-item" data-value="1"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="2"></span><span tabindex="0" role="button" class="ql-picker-item ql-selected"></span></span></span><select class="ql-header" style="display: none;"><option value="1"></option><option value="2"></option><option selected="selected"></option></select></span><span class="ql-formats"><button type="button" class="ql-bold"><svg viewBox="0 0 18 18"> <path class="ql-stroke" d="M5,4H9.5A2.5,2.5,0,0,1,12,6.5v0A2.5,2.5,0,0,1,9.5,9H5A0,0,0,0,1,5,9V4A0,0,0,0,1,5,4Z"></path> <path class="ql-stroke" d="M5,9h5.5A2.5,2.5,0,0,1,13,11.5v0A2.5,2.5,0,0,1,10.5,14H5a0,0,0,0,1,0,0V9A0,0,0,0,1,5,9Z"></path> </svg></button><button type="button" class="ql-italic"><svg viewBox="0 0 18 18"> <line class="ql-stroke" x1="7" x2="13" y1="4" y2="4"></line> <line class="ql-stroke" x1="5" x2="11" y1="14" y2="14"></line> <line class="ql-stroke" x1="8" x2="10" y1="14" y2="4"></line> </svg></button><button type="button" class="ql-underline"><svg viewBox="0 0 18 18"> <path class="ql-stroke" d="M5,3V9a4.012,4.012,0,0,0,4,4H9a4.012,4.012,0,0,0,4-4V3"></path> <rect class="ql-fill" height="1" rx="0.5" ry="0.5" width="12" x="3" y="15"></rect> </svg></button></span><span class="ql-formats"><button type="button" class="ql-image"><svg viewBox="0 0 18 18"> <rect class="ql-stroke" height="10" width="12" x="3" y="4"></rect> <circle class="ql-fill" cx="6" cy="7" r="1"></circle> <polyline class="ql-even ql-fill" points="5 12 5 11 7 9 8 10 11 7 13 9 13 12 5 12"></polyline> </svg></button><button type="button" class="ql-code-block"><svg viewBox="0 0 18 18"> <polyline class="ql-even ql-stroke" points="5 7 3 9 5 11"></polyline> <polyline class="ql-even ql-stroke" points="13 7 15 9 13 11"></polyline> <line class="ql-stroke" x1="10" x2="8" y1="5" y2="13"></line> </svg></button></span></div><div id="kt_ecommerce_add_category_description" name="description" class="min-h-200px mb-2 ql-container ql-snow"><div class="ql-editor ql-blank" data-gramm="false" contenteditable="true" data-placeholder=""><p><br></p></div><div class="ql-clipboard" contenteditable="true" tabindex="-1"></div><div class="ql-tooltip ql-hidden"><a class="ql-preview" rel="noopener noreferrer" target="_blank" href="about:blank"></a><input type="text" data-formula="e=mc^2" data-link="https://quilljs.com" data-video="Embed URL"><a class="ql-action"></a><a class="ql-remove"></a>
                                        </div></div>
                                <!--end::Editor-->
                                <!--begin::Description-->
                                <div class="text-muted fs-7">Set a description to the category for better visibility.</div>
                                <!--end::Description-->
                            </div> --}}
                            <!--end::Input group-->
                            <!--begin::Label-->
                            <br>

                            <label class="form-label">Tags</label>
                            <!--end::Label-->
                            <!--begin::Editor-->
                            <input name='tags' value='{{ $category->tags }}' class="form-control p-2">
                            {{-- <tags class="tagify form-control mb-2 tagify--noTags tagify--empty" tabindex="-1">
                            <span contenteditable="" tabindex="0" data-placeholder="​" aria-placeholder="" class="tagify__input" role="textbox" aria-autocomplete="both" aria-multiline="false"></span>
                            ​
                            </tags> --}}
                            {{-- <input id="kt_ecommerce_add_category_meta_keywords" name="kt_ecommerce_add_category_meta_keywords" class="form-control mb-2"> --}}
                            <!--end::Editor-->
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Set a list of keywords that the category is related to. Separate the keywords by adding a comma
                            <code>,</code>between each keyword.</div>

                            <br>
                            <!--Variations-->
                            <label class="form-label">Add Variations</label>
                            <div class="field_wrapper text-end">
                            <a href="javascript:void(0);" class="add_button" title="Add field">
                                <i class="fa fa-plus p-2 mb-2 bg-success text-light "></i>
                                @foreach ($variation as $vr)
                                <input type="text" name="variation[]" value="{{ $vr }}" class="form-control p-2 my-2"/>
                                @endforeach
                            </a>
                            </div>

                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::General options-->
                    <!--begin::Meta options-->

                    <!--end::Meta options-->

                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="products.html" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancel</a>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                            <span class="indicator-label">Save Changes</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                </div>
                <!--end::Main column-->
            <div></div></form>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
@endsection
@section('script')
<script>
    // The DOM element you wish to replace with Tagify
var input = document.querySelector('input[name=tags]');

// initialize Tagify on the above input node reference
new Tagify(input)
</script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
@endsection

