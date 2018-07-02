@extends('layouts.productMaster')
@section('bg-img',asset('assets/img/header-sliders/products_01.jpg'))
@section('product-cat')
<h2 class="b-b p-b">Categories <span><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a></span></h2>
@endsection

@section('product-content')
    @section('subDepartmentLink')
        @foreach($subDepartments as $subDepartment)
            <a href="{{route('featured')."?category=$subDepartment->id"}}">{{$subDepartment->departmentSubName}}</a>
        @endforeach
    @endsection
    @include('includes.productTopNav')
    @if(Session::has('error') || empty($subDepartments) || empty($products_featured))
        <div class="prdctNotFound">No Featured Products Found..</div>
    @else
    <aside class="prodlist" id="listShow">
        @foreach($products_featured as $product)
            <a class='feaProduct_box hvr-grow productClass indiProducts' data-fancybox href='{{asset("assets/img/products/$product->imageFile")}}'  data-feature='{!! nl2br($product->details) !!}' data-idProduct={{$product->idProduct}}>
                <div class='featuredPrdctimagecontainer'><img src='{{asset("assets/img/products/$product->imageFile")}}' onerror="if (this.src != '{{asset('assets/img/error.png')}}') this.src = '{{asset('assets/img/error.png')}}';"></div>
                <p class='feaprod_details'> {!! nl2br($product->details) !!}</p>
            </a>
        @endforeach
    </aside>
    {{ $products_featured->links() }}
    @endif
@endsection