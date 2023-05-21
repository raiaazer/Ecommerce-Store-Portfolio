@extends('user.layouts.layout')

@section('body')

<main class="main">
    <div class="home-slider slide-animate owl-carousel owl-theme show-nav-hover nav-big">
        @foreach(explode(',', $settings->banner_images) as $image)
            @php $image = trim($image) @endphp
        <div class="home-slide home-slide1 banner d-flex align-items-center">
            <img class="slide-bg" src="{{ asset('storage/sites/' . $image) }}"
                style="background-color: #ecc;" alt="home banner">
            <div class="banner-layer appear-animate" data-animation-name="fadeInUpShorter">

                <h4 class="m-b-4">{{ $settings->name }}</h4>

                <a href="demo3-shop.html" class="btn btn-dark btn-xl" role="button">Shop Now</a>
            </div><!-- End .banner-layer -->
        </div><!-- End .home-slide -->
        @endforeach
    </div><!-- End .home-slider -->

    <section class="container">
        <h2 class="section-title ls-n-15 text-center pt-2 m-b-4">Shop By Category</h2>

        <div class="owl-carousel owl-theme nav-image-center show-nav-hover nav-outer cats-slider appear-animate"
            data-animation-name="fadeInUpShorter" data-animation-delay="200" data-animation-duration="1000">
            @foreach ($categories as $category)
            <div class="product-category">
                <a href="demo3-shop.html">
                    <figure>
                        @if ($category->image)
                        <img src="{{ Storage::url($category->image) }}" width="273" height="273"
                            alt="category" class="resize" style="height: 273px; object-fit:cover;" />
                        @endif
                    </figure>
                    <div class="category-content">
                        <h3>{{ $category->name }}</h3>
                        <span><mark class="count">{{ $category->products_count }}</mark> products</span>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
    </section>

    <section class="container pb-3 mb-1">
        <h2 class="section-title ls-n-15 text-center pb-2 m-b-4">Popular Products</h2>

        <div class="row py-4">
            @foreach ($products as $product)
            <div class="col-6 col-sm-4 col-md-3 col-xl-2 appear-animate" data-animation-name="fadeIn"
            data-animation-delay="300" data-animation-duration="1000">
            <div class="product-default inner-quickview inner-icon">
                <figure style="width: 177px; height:177px;" >
                    <a href="demo3-product.html">
                        @if (!empty($product->product_images))
                        @php
                            $images = explode(',', $product->product_images);
                        @endphp

                        @foreach ($images as $image)
                            <img src="{{ asset('storage/products/' . trim($image)) }}" width="273"
                            height="273" alt="productr" style="height:100%; object-fit:cover;" />
                        @endforeach
                        @endif
                    </a>
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
                    <div class="btn-icon-group">
                        <a href="{{ route('cart.store', $product->id) }}" class="btn-icon btn-add-cart 1product-type-simple"><i
                                class="icon-shopping-cart"></i></a>
                    </div>
                    <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick
                        View</a>
                </figure>
                <div class="product-details">
                    <div class="category-wrap">
                        <div class="category-list">
                            <a href="demo3-shop.html" class="product-category">{{ $product->category->name }}</a>
                        </div>
                    </div>
                    <h3 class="product-title">
                        <a href="demo3-product.html">{{ $product->name }}</a>
                    </h3>
                    <div class="price-box">
                        @if ($product->discount != 0)
                            <span class="old-price">${{ $product->price }}</span>
                            <span class="product-price">${{ $product->price - ($product->price * $product->discount / 100) }}</span>
                        @else
                            <span class="product-price">${{ $product->price }}</span>
                        @endif
                    </div><!-- End .price-box -->
                </div><!-- End .product-details -->
            </div>
            </div>
            @endforeach
        </div>

        <hr class="mt-3 mb-6">

        <div class="row feature-boxes-container pt-2">
            <div class="col-sm-6 col-lg-3 appear-animate" data-animation-name="fadeInRightShorter"
                data-animation-delay="300" data-animation-duration="1000">
                <div class="feature-box feature-box-simple text-center">
                    <i class="sicon-earphones-alt"></i>

                    <div class="feature-box-content p-0">
                        <h3 class="text-uppercase">Customer Support</h3>
                        <h5>Need Assistence?</h5>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna,
                            et dapibus lacus. Lorem ipsum dolor sit amet.</p>
                    </div><!-- End .feature-box-content -->
                </div><!-- End .feature-box -->
            </div><!-- End .col-lg-3 -->

            <div class="col-sm-6 col-lg-3 appear-animate" data-animation-name="fadeInRightShorter"
                data-animation-delay="100" data-animation-duration="1000">
                <div class="feature-box feature-box-simple text-center">
                    <i class="sicon-credit-card"></i>

                    <div class="feature-box-content p-0">
                        <h3 class="text-uppercase">Secured Payment</h3>
                        <h5>Safe & Fast</h5>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna,
                            et dapibus lacus. Lorem ipsum dolor sit amet.</p>
                    </div><!-- End .feature-box-content -->
                </div><!-- End .feature-box -->
            </div><!-- End .col-lg-3 -->

            <div class="col-sm-6 col-lg-3 appear-animate" data-animation-name="fadeInLeftShorter"
                data-animation-delay="100" data-animation-duration="1000">
                <div class="feature-box feature-box-simple text-center">
                    <i class="sicon-action-undo"></i>

                    <div class="feature-box-content p-0">
                        <h3 class="text-uppercase">Free Returns</h3>
                        <h5>Easy & Free</h5>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna,
                            et dapibus lacus. Lorem ipsum dolor sit amet.</p>
                    </div><!-- End .feature-box-content -->
                </div><!-- End .feature-box -->
            </div><!-- End .col-lg-3 -->

            <div class="col-sm-6 col-lg-3 appear-animate" data-animation-name="fadeInLeftShorter"
                data-animation-delay="300" data-animation-duration="1000">
                <div class="feature-box feature-box-simple text-center">
                    <i class="icon-shipping"></i>

                    <div class="feature-box-content p-0">
                        <h3 class="text-uppercase">Free Shipping</h3>
                        <h5>Orders Over $99</h5>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna,
                            et dapibus lacus. Lorem ipsum dolor sit amet.</p>
                    </div><!-- End .feature-box-content -->
                </div><!-- End .feature-box -->
            </div><!-- End .col-lg-3 -->
        </div><!-- End .row .feature-boxes-container-->
    </section>
</main><!-- End .main -->
@endsection
