@extends('layouts.productMaster')
@section('bg-img', asset('assets/img/header-sliders/products.jpg'))
@section('product-content')
    <h2>Thousands of Options</h2>
    <div class='product-body'>
        <div><img src='{{ asset('assets/img/about-us/indoor.jpg') }}'></div>
        <div>
            <p style="text-align: justify">Explore limitless options such as adhesives and sealants, plants, building
                maintenance, plumbing, pet
                care, home decor, and everything else you need for your building and home improvement projects.</p>
        </div>
    </div>
@endsection
