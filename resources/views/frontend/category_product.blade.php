@extends('frontend.master');
@section('content')
    <!-- Start page-title -->
    <section class="wpo-page-title">
        <h2 class="d-none">Hide</h2>
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="wpo-breadcumb-wrap">
                        <ol class="wpo-breadcumb-wrap">
                            <li><a href="index.html">Home</a></li>
                            <li>{{ $categories->category_name }}</li>
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->

    <!-- start of themart-interestproduct-section -->
    <section class="themart-interestproduct-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="wpo-section-title">
                        <h2>{{ $categories->category_name }}</h2>
                    </div>
                </div>
            </div>
            <div class="product-wrap">
                <div class="row">
                    @forelse ($category_products as $category_product)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="product-item">
                                <div class="image">
                                    <img src="{{ asset('uploads/product/preview') }}/{{ $category_product->pre_image }}"
                                        alt="">
                                    <div class="tag new">New</div>
                                </div>
                                <div class="text">
                                    <h2><a href="" title="{{ $category_product->product_name }}">
                                            @if (Str::length($category_product->product_name) > 12)
                                                {{ Str::substr($category_product->product_name, 0, 12) . '....' }}
                                            @else
                                                {{ $category_product->product_name }}
                                            @endif
                                        </a></h2>
                                    <div class="rating-product">
                                        <i class="fi flaticon-star"></i>
                                        <i class="fi flaticon-star"></i>
                                        <i class="fi flaticon-star"></i>
                                        <i class="fi flaticon-star"></i>
                                        <i class="fi flaticon-star"></i>
                                        <span>130</span>
                                    </div>
                                    <div class="price">
                                        <span class="present-price">&#2547;
                                            {{ number_format($category_product->after_discounter) }}</span>
                                        @if ($category_product->discount)
                                            <del class="old-price">&#2547;
                                                {{ number_format($category_product->price) }}</del>
                                        @endif
                                    </div>
                                    <div class="shop-btn">
                                        <a class="theme-btn-s2" href="product.html">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                    <div class="alert alert-info">
                        <h3>Product no found</h3>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
    <!-- End of themart-interestproduct-section -->
@endsection
