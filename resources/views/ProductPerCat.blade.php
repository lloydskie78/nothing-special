@extends('layouts.productMaster')
@section('bg-img',asset('assets/img/header-sliders/products.jpg'))
@section('product-cat')
    <h2 class="b-b p-b">Categories <span><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a></span>
    </h2>
@endsection

@section('product-content')

@section('subDepartmentLink')
    @foreach($subDepartments as $subDepartment)
        <a href="{{route('productPerCat',[$subDepartment->idDepartment]).'?subCat='.$subDepartment->id.''}}">{{$subDepartment->departmentSubName}}</a>
    @endforeach
@endsection
@include('includes.productTopNav')

@if(Session::has('error'))
    <div class="prdctNotFound">{{Session::get('error')}}</div>
@else
    <aside class="prodlist" id="listShow">
        @foreach($products as $product)
            <a class='product_box hvr-grow productClass indiProducts' data-fancybox
               href='{{asset("assets/img/products/$product->imageFile")}}'
               data-feature='{!! nl2br($product->details) !!}' data-idProduct={{$product->idProduct}}>
                <div class='prdctimagecontainer'><img src='{{asset("assets/img/products/$product->imageFile")}}' alt="{{$product->details}}"
                                                      onerror="if (this.src != '{{asset('assets/img/error.png')}}') this.src = '{{asset('assets/img/error.png')}}';">
                </div>
                <hr>
                <p class='prod_details'> {!! nl2br($product->details) !!}</p>
            </a>
        @endforeach
    </aside>
    {{ $products->links() }}
@endif

@endsection
