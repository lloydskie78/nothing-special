@extends('layouts.master')
@section('bg-img',asset('assets/img/imgwebp/Careers.webp'))
@section('content')

<div class="carcontent col-10 pageContent">
    <div class="carheadr">
        @foreach($jobcat as $cat)
            <a href='javascript:void();' class='hvr-float jobcat' data-id='{{$cat->id}}'>{{$cat->name}}</a>
        @endforeach
    </div>
    <h1 class="cartitle mtop">Store Support (Davao Based)</h1>
    <div class="carbdy"></div>
    <div class="carfootr">
        <div class="requirements">
            <h5>Requirements:</h5>
            <ul>
                <li>Comprehensive Resume</li>
                <li>Recent 2x2 picture (white background)</li>
                <li>Transcript of records</li>
            </ul>
        </div>
        <div>
            <h5>Please submit your application to:</h5>
            <p><strong>Human Resources Manager</strong><br>
                DecoArts Marketing, Inc.<br>
                Quimpo Blvd., Matina, Davao City<br>
                Tel. Nos.: (082) 296-1821 to 23 </p>
            <a class="btn modalTrigger hvr-pulse-grow" id="applyLink" href="#">Apply Here <i class="fas fa-caret-right"></i></a>
        </div>
    </div>
</div>
@endsection 