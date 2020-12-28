@extends('layouts.productMaster')
@section('bg-img', asset('assets/img/banner/Products.jpg'))
@section('product-cat')
    <h2 class="b-b p-b">Categories <span><a href="javascript:void(0)" class="closebtn"
                onclick="closeNav()">&times;</a></span>
    </h2>
@endsection

@section('product-content')

    @include('includes.productTopNav')

    @if (Session::has('error'))
        <div class="prdctNotFound">{{ Session::get('error') }}</div>
    @else
        <aside class="prodlist" id="listShow">
            @if (count($products) > 0)
                @foreach ($products as $product)

                    <!-- you only removed this code -->
                    <!-- href='{{ asset("assets/img/products/$product->imageFile") }}' -->
                    <!-- route('productprofile', ['id'=>{{ $product->idProduct }}])  -->

                    <a class='product_box hvr-grow productClass indiProducts' id='objprod'
                        href="{{ route('productprofile', ['id' => $product->idProduct]) }}"
                        data-feature='{!!  nl2br($product->details) !!}' data-idProduct={{ $product->idProduct }}>
                        <div class='prdctimagecontainer'><img src='{{ asset("assets/img/products/$product->imageFile") }}'
                                alt="{{ $product->details }}"
                                onerror="if (this.src != '{{ asset('assets/img/error.png') }}') this.src = '{{ asset('assets/img/error.png') }}';">
                            <hr>
                            <br>
                            Ratings:
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>

                            <p class='prod_details'> {!! nl2br($product->details) !!}
                        </div>

                    </a>
                @endforeach
        </aside>

    @else
        <div class="prdctNotFound" style='width:100%;'>No Products Found..</div>
    @endif
    @endif

@endsection

<style>
    .checked {
        color: orange;
    }

</style>
