@extends('layouts.master')
@section('bg-img',asset('assets/img/header-sliders/matina.jpg'))
@section('content')
<div class="newsNupbody col-10 pageContent">
    <h1 class="header-text">What's new</h1>
    <p class="text">We are constantly growing! Our stores nationwide are open 7 days a week and ready to assist you for your building projects and home improvement needs.</p>
    <div class="nwsNupcontainer">

        @foreach($news_list as $news)
            {{--$output = preg_replace('!\s+!', ' ', $row->content);--}}
            {{--$output = strip_tags($output);--}}
            <div class='nwsNuplist'>
    				<div class='nwsNupimg'><img src='{{asset("assets/img/news/$news->imageFile")}}'></div>
    				<div class='nwsNupdesc'>
    				<h4>{{$news->title}}</h4>
    				<p data-simplebar>{!! $news->content !!}</p>
   				</div>
    			</div>
        @endforeach
    </div>

	<div class="news-pagination">
        {{ $news_list->links() }}
    </div>
</div>
@endsection