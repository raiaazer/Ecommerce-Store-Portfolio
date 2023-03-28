@extends('admin.layouts.layout')
@section('css')
<style>
.bluebtn:hover {
    background-color: #F1FAFF;
    color: #009EF7;
    width: 100%;
  }

.bluebtn{
    background-color: white;
    border: none;
    color:none;
    text-decoration: none;
  }
</style>

@endsection
@section('body')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Products-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input type="text" data-kt-ecommerce-product-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Product" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        {{-- <div class="w-100 mw-150px">
                            <!--begin::Select2-->
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Status" data-kt-ecommerce-product-filter="status">
                                <option></option>
                                <option value="all">All</option>
                                <option value="published">Published</option>
                                <option value="scheduled">Scheduled</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <!--end::Select2-->
                        </div> --}}
                        <!--begin::Add product-->
                        <a href="{{ route('product.create') }}" class="btn btn-primary">Add Product</a>
                        <!--end::Add product-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_products_table .form-check-input" value="1" />
                                    </div>
                                </th>
                                <th class="min-w-200px">Product</th>
                                <th class="text-end min-w-100px">SKU</th>
                                <th class="text-end min-w-70px">Qty</th>
                                <th class="text-end min-w-100px">Price</th>
                                <th class="text-end min-w-100px">Discount</th>
                                <th class="text-end min-w-100px">Status</th>
                                <th class="text-end min-w-70px">Actions</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600">
                            <!--begin::Table row-->
                            @foreach ($products as $product)
                            <tr>
                                <!--begin::Checkbox-->
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <!--end::Checkbox-->
                                <!--begin::Category=-->
                                <td>
                                    <div class="d-flex">
                                        <!--begin::Thumbnail-->
                                        @if ($product->image)
                                            <img src="{{ asset('/storage/products/'.$product->image) }}" width="50px" height="50px" class="symbol symbol-50px"/>
                                        @endif

                                        <!--end::Thumbnail-->
                                        <div class="ms-5">
                                            <!--begin::Title-->
                                            <a href="{{ route('product.edit', $product->id) }}" class="text-gray-800 text-hover-primary fs-5 fw-bolder mb-1" data-kt-ecommerce-category-filter="category_name">{{ $product->name }}</a>
                                            <!--end::Title-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7 fw-bolder">{{ $product->description }}</div>
                                            <!--end::Description-->
                                        </div>
                                    </div>

                                </td>
                                <!--end::Category=-->
                                <!--begin::SKU=-->
                                <td class="text-end pe-0">
                                    <span class="fw-bolder">{{ $product->sku }}</span>
                                </td>
                                <!--end::SKU=-->
                                <!--begin::Qty=-->
                                <td class="text-end pe-0" data-order="35">
                                    @if($product->quantity == 0)
                                    <span class="badge badge-light-danger">Sold out</span>
                                    <span class="fw-bolder text-danger ms-3">{{ $product->quantity }}</span>

                                    @elseif($product->quantity > 0 && $product->quantity < 10)
                                    <span class="badge badge-light-warning">Low stock</span>
                                    <span class="fw-bolder text-warning ms-3">{{ $product->quantity }}</span>

                                    @else
                                    <span class="fw-bolder ms-3">{{ $product->quantity }}</span>
                                    @endif
                                </td>
                                <!--end::Qty=-->
                                <!--begin::Price=-->
                                <td class="text-end pe-0">
                                    <span class="fw-bolder text-dark">${{ $product->price }}</span>
                                </td>
                                <!--end::Price=-->
                                <!--begin::Discount-->
                                <td class="text-end pe-0">
                                    <span class="fw-bolder text-dark">{{ $product->discount }}%</span>
                                </td>
                                <!--end::Discount-->
                                <!--begin::Status=-->
                                <td class="text-end pe-0">
                                    @if($product->status != 'Published')
                                    <div class="badge badge-light-danger">{{ $product->status }}</div>
                                    @else
                                    <div class="badge badge-light-success">{{ $product->status }}</div>
                                    @endif
                                </td>
                                <!--end::Status=-->
                                <!--begin::Action=-->
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                    <span class="svg-icon svg-icon-5 m-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon--></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{ route('product.edit', $product->id) }}" class="menu-link px-3">Edit</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <form action="{{ route('product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="menu-link px-3 bluebtn" data-kt-ecommerce-category-filter="delete_row">Delete</button>
                                            </form>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                                <!--end::Action=-->
                            </tr>
                            <!--end::Table row-->
                            @endforeach

                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Products-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
@endsection
