@extends('admin.layouts.layout')
@section('css')
<style>
    .remove-icon {
        position: absolute;
        top: 0;
        right: 0;
        background-color: #ff0000;
        color: #ffffff;
        font-weight: bold;
        font-size: 14px;
        padding: 3px;
        margin: 2px;
        cursor: pointer;
    }
</style>
@endsection
@section('body')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">

            <!--begin::Basic info-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">Settings</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <!--begin::Form-->
                    @if (!is_null($settings))
                    {{-- <form id="kt_account_profile_details_form" method="POST" action="{{ route('site.update') }}" enctype="multipart/form-data"  class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate"> --}}
                    <form id="kt_account_profile_details_form" method="POST" action="{{ route('site.update', ['id' => $settings->id]) }}" enctype="multipart/form-data"  class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                        @csrf
                        <input type="hidden" name="id" value="{{ $settings->id }}">
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Logo</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('admin_assets/assets/media/svg/avatars/blank.svg')">
                                        <!--begin::Preview existing avatar-->
                                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ asset('storage/sites/' . $settings->logo) }}')"></div>
                                        {{-- <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ asset('storage/sites/' . $settings->logo) }}')"></div> --}}

                                        <!--end::Preview existing avatar-->
                                        <!--begin::Label-->
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="Change avatar">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file" name="logo" accept=".png, .jpg, .jpeg">
                                            <input type="hidden" name="avatar_remove">

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
                                    <!--begin::Hint-->
                                    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                    <!--end::Hint-->
                                </div>
                                {{-- <div class="col-lg-4">
                                <img src="{{ asset('storage/sites/' . $settings->logo) }}" class="img-fluid12" alt="logo" width="125px" height="125px">
                                <div class="form-text">Already added logo</div>

                                </div> --}}
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Banner Images</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <input type="file" id="input1" class="input1" name="banner_images[]" accept="image/*" multiple>
                                    <div class="preview1"></div>
                                    @if($settings->banner_images)
                                    <div class="d-flex flex-wrap">
                                        @foreach(explode(',', $settings->banner_images) as $banner)
                                        <div class="position-relative m-2">
                                            <img src="{{ asset('storage/sites/' . $banner) }}" class="img-fluid1" alt="banner" width="173px" height="173px">
                                            <span class="badge badge-sm delete-banner remove-icon" data-filename="{{ $banner }}" data-url="{{ route('site.deleteBannerImage', $banner) }}">
                                                <i class="bi bi-x"></i>
                                            </span>

                                        </div>
                                        @endforeach
                                    </div>
                                    @endif

                                    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Shop Name</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                            <input type="text" name="name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Name" value="{{ $settings->name }}">
                                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Address</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="text" name="address" class="form-control form-control-lg form-control-solid" placeholder="Address" value="{{ $settings->address }}">
                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">Phone</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Phone number must be active" aria-label="Phone number must be active"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="tel" name="phone" class="form-control form-control-lg form-control-solid" placeholder="Phone number" value="{{ $settings->phone }}">
                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6 required">Email</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="email" class="form-control form-control-solid" name="email" placeholder="Email" value="{{ $settings->email }}">
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Shop Description</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="text" name="shop_description" class="form-control form-control-lg form-control-solid" placeholder="Shop Description" value="{{ $settings->shop_description }}">
                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                <!--end::Col-->
                            </div>
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">Country</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Country of origination" aria-label="Country of origination"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <select name="country_id" aria-label="Select a Country" data-control="select2" data-placeholder="Select a country..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-nhn6" tabindex="-1" aria-hidden="true">
                                        <option value="">Select a Country...</option>
                                        @foreach(App\Models\Country::all() as $country)
                                            <option value="{{ $country->id }}" @if($country->id == $settings->country_id) selected @endif>{{ $country->name }} - {{ $country->code }}</option>
                                        @endforeach
                                    </select>
                            </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Facebook</label>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                            <input type="url" name="facebook" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="add link" value="{{ $settings->facebook }}">
                                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Twitter</label>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                            <input type="url" name="twitter" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="add link" value="{{ $settings->twitter }}">
                                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Instagram</label>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                            <input type="url" name="instagram" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="add link" value="{{ $settings->instagram }}">
                                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Card body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save Changes</button>
                        </div>
                        <!--end::Actions-->
                    <input type="hidden"><div></div></form>
                    @else
                    <form id="kt_account_profile_details_form" method="POST" action="{{ route('site.store') }}" enctype="multipart/form-data"  class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                        @csrf
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Logo</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    {{-- <div id="image-preview"></div>
                                    <input type="file" name="banner_images[]" multiple> --}}
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('../assets/media/svg/avatars/blank.svg')">
                                        <!--begin::Preview existing avatar-->
                                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url(../assets/media/avatars/300-1.jpg)"></div>
                                        <!--end::Preview existing avatar-->
                                        <!--begin::Label-->
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="Change avatar">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file" name="logo" accept=".png, .jpg, .jpeg">
                                            <input type="hidden" name="avatar_remove">
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
                                    <!--begin::Hint-->
                                    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                    <!--end::Hint-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Banner Images</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <input type="file" id="input1" class="input1" name="banner_images[]" accept="image/*" multiple>
                                    <div class="preview1"></div>
                                    {{-- @if($settings->banner_images)
                                    <div class="d-flex flex-wrap">
                                        @foreach(explode(',', $settings->banner_images) as $banner)
                                        <div class="position-relative m-2">
                                            <img src="{{ asset('storage/sites/' . $banner) }}" class="img-fluid1" alt="banner" width="173px" height="173px">

                                            <button type="button" class="btn btn-sm btn-danger delete-banner" data-filename="{{ $banner }}" data-url="{{ route('site.deleteBannerImage', $banner) }}">
                                                <i class="bi bi-x"></i>
                                            </button>


                                        </div>
                                        @endforeach
                                    </div>
                                    @endif --}}

                                    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Shop Name</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                            <input type="text" name="name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Name" >
                                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                        <!--end::Col-->
                                        {{-- <!--begin::Col-->
                                        <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                            <input type="text" name="lname" class="form-control form-control-lg form-control-solid" placeholder="Last name" value="Smith">
                                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                        <!--end::Col--> --}}
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Address</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="text" name="address" class="form-control form-control-lg form-control-solid" placeholder="Address" >
                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">Phone</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Phone number must be active" aria-label="Phone number must be active"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="tel" name="phone" class="form-control form-control-lg form-control-solid" placeholder="Phone number" >
                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6 required">Email</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="email" class="form-control form-control-solid" name="email" placeholder="Email" >
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Shop Description</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="text" name="shop_description" class="form-control form-control-lg form-control-solid" placeholder="Shop Description" >
                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                <!--end::Col-->
                            </div>
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">
                                    <span class="required">Country</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Country of origination" aria-label="Country of origination"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <select name="country_id" aria-label="Select a Country" data-control="select2" data-placeholder="Select a country..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-nhn6" tabindex="-1" aria-hidden="true">
                                        {{-- <option value="" data-select2-id="select2-data-12-axgw">Select a Country...</option> --}}
                                        <option value="">Select a Country...</option>
                                        @foreach(App\Models\Country::all() as $country)
                                            <option value="{{ $country->id }}" >{{ $country->name }} - {{ $country->code }}</option>
                                        @endforeach
                                    </select>
                            </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Facebook</label>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                            <input type="url" name="facebook" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="add link" >
                                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Twitter</label>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                            <input type="url" name="twitter" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="add link" >
                                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Instagram</label>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                            <input type="url" name="instagram" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="add link" >
                                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Card body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save Changes</button>
                        </div>
                        <!--end::Actions-->
                    <input type="hidden"><div></div></form>
                    @endif
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Basic info-->

        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
@endsection
@section('script')
@if ($errors->any())
    <script>
        toastr.error("There were errors with your submission. Please fix them before continuing.");
    </script>
@endif
<script>
    $(document).on('click', '.delete-banner', function () {
    var filename = $(this).data('filename');
    var url = $(this).data('url');
    $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        type: 'DELETE',
        data: { filename: filename },
        success: function (response) {
            $('#banner-image-' + filename).remove();
            location.reload();
        }
    });
});

</script>
<script>
      document.querySelector('.input1').addEventListener('change', function() {
    previewImages('input1', 'preview1');
  });
</script>
<script>
function previewImages(inputId, previewClass) {
  var preview = document.querySelector(`.${previewClass}`);
  var files = document.querySelector(`#${inputId}`).files;

  function readAndPreview(file) {
    // Make sure `file.type` matches the desired image file types
    if (/^(image\/jpeg|image\/png|image\/gif)$/.test(file.type)) {
      var reader = new FileReader();

      reader.addEventListener("load", function () {
        var image = new Image();
        image.height = 100;
        image.width = 100;
        image.style.margin = '5px';
        image.title = file.name;
        image.src = this.result;
        preview.appendChild(image);
      }, false);

      reader.readAsDataURL(file);
    }
  }

  if (files) {
    [].forEach.call(files, readAndPreview);
  }
}

</script>

@endsection
