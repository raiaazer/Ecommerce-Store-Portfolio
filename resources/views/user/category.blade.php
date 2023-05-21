@extends('user.layouts.layout')
@section('body')
<br>
<main class="main pt-4">

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
</main>
@endsection
