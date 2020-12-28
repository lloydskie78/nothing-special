@extends('layouts.productMaster')
@section('bg-img', asset('assets/img/banner/Products.jpg'))
@section('product-cat')
    <h2 class="b-b p-b">Categories <span><a href="javascript:void(0)" class="closebtn"
                onclick="closeNav()">&times;</a></span>
    </h2>
@endsection

{{-- FOR FEATURED PRODUCTS --}}
@section('featured-products')
    <div id="featuredProductItemContainer" style="margin-top: 30px;">
        @if (Session::has('error') || empty($subDepartments) || empty($products_featured))
            <div class="prdctNotFound">No Featured Products Found..</div>
        @else
            {{-- <aside class="prodlist" id="listShow"> --}}
                <div id="owl-featured-products" class="owl-carousel">
                    @foreach ($products_featured as $product)
                        <div class="item" id="featuredProductItem"> 
                            <a class='feaProduct_box hvr-grow productClass indiProducts' data-fancybox
                                href='{{ asset("assets/img/products/featuredImage/$product->feaImageFile") }}'
                                data-feature='{!!  nl2br($product->details) !!}' data-idProduct={{ $product->idProduct }}>
                                <img class="owl-lazy"
                                    data-src='{{ asset("assets/img/products/featuredImage/$product->feaImageFile") }}'
                                    alt="{{ $product->details }}"
                                    onerror="if (this.src != '{{ asset('assets/img/error.png') }}') this.src = '{{ asset('assets/img/error.png') }}';">
                            </a>
                        </div>
                    @endforeach
                </div>

                {{--
            </aside> --}}
            {{ $products_featured->links() }}
        @endif
    </div>
@endsection

{{-- FOR PRODUCTS --}}
@section('product-content')
    @include('includes.productTopNav')
    @if (Session::has('error'))
        <div class="prdctNotFound">{{ Session::get('error') }}</div>
    @else
        @if (count($products) > 0)
            <aside class="prodlist" id="listShow">
                @foreach ($products as $product)
                    <a class='product_box hvr-grow productClass indiProducts' data-fancybox
                        href='{{ asset("assets/img/products/$product->imageFile") }}'
                        data-feature='{!!  nl2br($product->details) !!}' data-idProduct={{ $product->idProduct }}>
                        <div class='prdctimagecontainer'><img src='{{ asset("assets/img/products/$product->imageFile") }}'
                                alt="{{ $product->details }}"
                                onerror="if (this.src != '{{ asset('assets/img/error.png') }}') this.src = '{{ asset('assets/img/error.png') }}';">
                        </div>
                        <hr>
                        <p class='prod_details'> {!! nl2br($product->details) !!}</p>
                    </a>
                @endforeach
            </aside>
            {{ $products->links() }}
        @else
            <div class="prdctNotFound" style='width:100%;'>No Products Found..</div>
        @endif
    @endif
@endsection
