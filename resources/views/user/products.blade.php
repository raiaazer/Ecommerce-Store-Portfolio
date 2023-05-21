@extends('user.layouts.layout')
@section('css')
<link rel="stylesheet" href="{{ user_asset('/css/style.min.css') }}">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
@endsection
@section('body')

<main class="main pt-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 main-content">
                <div class="sticky-wrapper"><nav class="toolbox sticky-header" data-sticky-options="{'mobile': true}">
                    <div class="toolbox-left">
                        <a href="#" class="sidebar-toggle">
                            <svg data-name="Layer 3" id="Layer_3" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                <line x1="15" x2="26" y1="9" y2="9" class="cls-1"></line>
                                <line x1="6" x2="9" y1="9" y2="9" class="cls-1"></line>
                                <line x1="23" x2="26" y1="16" y2="16" class="cls-1"></line>
                                <line x1="6" x2="17" y1="16" y2="16" class="cls-1"></line>
                                <line x1="17" x2="26" y1="23" y2="23" class="cls-1"></line>
                                <line x1="6" x2="11" y1="23" y2="23" class="cls-1"></line>
                                <path d="M14.5,8.92A2.6,2.6,0,0,1,12,11.5,2.6,2.6,0,0,1,9.5,8.92a2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                                <path d="M22.5,15.92a2.5,2.5,0,1,1-5,0,2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                                <path d="M21,16a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z" class="cls-3"></path>
                                <path d="M16.5,22.92A2.6,2.6,0,0,1,14,25.5a2.6,2.6,0,0,1-2.5-2.58,2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                            </svg>
                            <span>Filter</span>
                        </a>

                        <div class="toolbox-item toolbox-sort">
                            <label>Sort By:</label>

                            <div class="select-custom">
                                <select name="orderby" id="sort-select" class="form-control">

                                    <option value="price">Sort by price: low to high</option>
                                    <option value="price-desc">Sort by price: high to low</option>
                                    <option value="alphabetical">Sort by alphabetical order</option>
                                </select>
                            </div>
                            <!-- End .select-custom -->
                        </div>
                    </div>
                    <!-- End .toolbox-left -->
                </nav></div>

                <div class="row product-container">
                    <div class="col-12">
                        <div class="row">
                            @foreach ($products as $product)
                            <div class="col-6 col-sm-4">
                                <div class="product-default">
                                    <figure class="m-2">
                                        @if ($product->image)
                                        <a href="{{ route('product.show', $product->id) }}">
                                            <img src="{{ Storage::url('/products/'.$product->image) }}" alt="{{ $product->name }}" style="width: 273px; height: 273px; object-fit:cover;">
                                        </a>
                                        @endif
                                        <div class="label-group">
                                            @if($product->quantity < 20)
                                            <div class="product-label label-hot">
                                                HOT
                                            </div>
                                            @endif
                                            @if($product->discount != 0)
                                            <div class="product-label label-sale">{{$product->discount}}% Off</div>
                                            @endif
                                        </div>
                                    </figure>

                                    <div class="product-details">
                                        <div class="category-wrap">
                                            <div class="category-list">
                                                <a href="{{ route('category.show', $product->category_id) }}" class="product-category">{{ $product->category->name }}</a>
                                            </div>
                                        </div>

                                        <h3 class="product-title">
                                            <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
                                        </h3>

                                        <div class="price-box">
                                            @if ($product->discount != 0)
                                                <span class="old-price">${{ $product->price }}</span>
                                                <span class="product-price">${{ $product->price - ($product->price * $product->discount / 100) }}</span>
                                            @else
                                                <span class="product-price">${{ $product->price }}</span>
                                            @endif
                                        </div>

                                        <div class="product-action">
                                            <a href="#" class="btn-icon-wish" title="wishlist"><i class="icon-heart"></i></a>
                                            <a href="{{ route('cart.store', $product->id) }}" class="btn-icon btn-add-cart"><i class="fa fa-arrow-right"></i><span>ADD TO CART</span></a>
                                            <a href="#" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                                        </div>
                                    </div>
                                    <!-- End .product-details -->
                                </div>
                            </div>
                            <!-- End .col-sm-4 -->
                            @endforeach
                        </div>
                    </div>
                </div>

                <nav class="toolbox toolbox-pagination">
                    <div class="pagination toolbox-item">
                        {{ $products->links() }}
                    </div>
                </nav>

            </div>
            <!-- End .col-lg-9 -->

            <div class="sidebar-overlay"></div>
            <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
                <div class="pin-wrapper" style="height: 1212.8px;"><div class="sidebar-wrapper" style="border-bottom: 0px none rgb(119, 119, 119); width: 280px;">


                    <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true" aria-controls="widget-body-3">Price</a>
                        </h3>

                        <div class="collapse show" id="widget-body-3">
                            <div class="widget-body pb-0">
                                <form action="{{ route('products.filterByPrice') }}" method="POST">
                                    @csrf

                                    <div class="price-slider-wrapper">
                                        <div id="price-slider" class="noUi-target noUi-ltr noUi-horizontal"></div>
                                    </div>

                                    <div class="filter-price-action d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="filter-price-text">
                                            Price:
                                            <span id="filter-price-range">$0 - $1000</span>
                                        </div>

                                        <!-- Add hidden input fields for min and max prices -->
                                        <input type="hidden" id="min_price" name="min_price" value="0">
                                        <input type="hidden" id="max_price" name="max_price" value="1000">

                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                    <!-- End .widget -->

                </div></div>
                <!-- End .sidebar-wrapper -->
            </aside>
            <!-- End .col-lg-3 -->
        </div>
        <!-- End .row -->
    </div>
</main>
@endsection
@section('js')
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>

<script>
    $(document).ready(function() {
        var priceSlider = $('#price-slider');
        var minPriceInput = $('#min_price');
        var maxPriceInput = $('#max_price');

        priceSlider.slider({
            range: true,
            min: 0,
            max: 1000,
            values: [0, 1000],
            slide: function(event, ui) {
                $('#filter-price-range').text('$' + ui.values[0] + ' - $' + ui.values[1]);
                minPriceInput.val(ui.values[0]);
                maxPriceInput.val(ui.values[1]);
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        var productContainer = $('.product-container');

        var sortSelect = $('#sort-select');

        sortSelect.change(function() {
            var selectedOption = $(this).val();

            if (selectedOption === 'price') {
                sortProductsByPrice('asc');
            } else if (selectedOption === 'price-desc') {
                sortProductsByPrice('desc');
            } else if (selectedOption === 'alphabetical') {
                sortProductsAlphabetically();
            } else {
                defaultSorting();
            }
        });

        function defaultSorting() {
            productContainer.find('.product-default').appendTo(productContainer);
        }

        function sortProductsByPrice(sortOrder) {
            var products = productContainer.find('.product-default').get();

            products.sort(function(a, b) {
                var priceA = parseFloat($(a).find('.product-price').text().replace('$', ''));
                var priceB = parseFloat($(b).find('.product-price').text().replace('$', ''));

                if (sortOrder === 'asc') {
                    return priceA - priceB;
                } else if (sortOrder === 'desc') {
                    return priceB - priceA;
                }
            });

            $.each(products, function(index, product) {
                productContainer.append(product);
            });
        }

        function sortProductsAlphabetically() {
            var products = productContainer.find('.product-default').get();

            products.sort(function(a, b) {
                var titleA = $(a).find('.product-title a').text().toUpperCase();
                var titleB = $(b).find('.product-title a').text().toUpperCase();

                return titleA.localeCompare(titleB);
            });

            $.each(products, function(index, product) {
                productContainer.append(product);
            });
        }
    });
</script>

@endsection
