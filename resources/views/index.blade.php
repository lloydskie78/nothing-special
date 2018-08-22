@extends('layouts.master')
@section('header-content')
    <video muted loop autoplay id="bgvid">
        <source type="video/mp4" src="{{asset('assets/img/header-sliders/header_video.mp4')}}">
        <source type="video/webm" src="{{asset('assets/img/header-sliders/header_video.webm')}}">
        Your browser does not support this video type
    </video>
@endsection
@section('content')

    <section id="featured_sction">
        <div class="featured col-10">

            @foreach($ctlinks as $link)
            <div class="thumbnails">
                <aside>
                    <h3 class="thmblabel">{{$link->name}}</h3>
                    <a href="{{route($link->page_link)}}"><div class="imgholder">
                            <img src="{{asset("assets/img/featured/$link->image")}}">
                            <div class="after"></div>
                            <div class="caption">
                                <div class="blur"></div>
                                <div class="caption-text">
                                    <p>{{$link->desc}}</p>
                                </div>
                            </div>
                        </div></a>
                </aside>
            </div>
            @endforeach


        </div>
    </section>
    <hr class="col-10">
    <section>
        <div class="brands col-10">
            <h1 class="header-text">Our Brands</h1>
            <p class="text">With an increasing portfolio of products sourced from local and international suppliers spanning from Asia, Australia, America, and Europe, CitiHardware continues to serve its customers by providing them with world-class products and a wide variety of the latest construction materials.</p>
            <div class="brandrow">
                <div class="owl-carousel">
                    @foreach($brands as $brand)
                    <div><img src="{{asset("assets/img/brands/$brand->imageFile")}}"></div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section id="aboutus_sction">
        <div class="aboutus col-12">
            <div class="aboutbox white">
                <h1 class="header-text">About Us</h1>
                <p>From its beginnings in 1998, CitiHardware is now one of the leading and fastest growing construction retail stores with 60 branches in the Philippines.</p>
                <p>At present, CitiHardware continues to lead in offering its customers great value on world-class products sourced from local and international suppliers. Excellent customer service is a top priority in driving customer satisfaction.</p>
                <p>CitiHardware is committed to providing its customers “Great Value Everyday” on products, made from the finest quality materials, at a price you can afford for building projects and home improvement needs.</p>
                <a href="{{route('about')}}" class="btn hvr-bounce-to-right">Read More...</a>
            </div>
        </div>
    </section>
    <section id="branches_sction">
        <div class="branches col-10">
            <div>
                <h1 class="header-text">Nationwide Network</h1>
                <p class="text">CitiHardware's 60 stores are strategically located throughout the Philippines' major regions of Luzon, Visayas, and Mindanao and is expected to continuously grow in the coming years.</p>
            </div>
            <div class="maprow">
                <div class="left">
                    <div>
                        <div class="places">
                            <ul class="luz">
                                <li>Luzon</li>
                                @foreach($luz as $l_branch)
                                <li><a class='indiv_branch hvr-grow' href='{{route('branch',['id' => $l_branch->idBranch])}}'>{{$l_branch->branchName}}</a></li>
                                @endforeach
                            </ul>
                            <ul class="vis">
                                <li>Visayas</li>
                                @foreach($vis as $v_branch)
                                    <li><a class='indiv_branch hvr-grow' href='{{route('branch',['id' => $v_branch->idBranch])}}'>{{$v_branch->branchName}}</a></li>
                                @endforeach
                            </ul>
                            <ul class="min">
                                <li>Mindanao</li>
                                @foreach($min as $m_branch)
                                    <li><a class='indiv_branch hvr-grow' href='{{route('branch',['id' => $m_branch->idBranch])}}'>{{$m_branch->branchName}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="right">

                    <map name="phpMap">
                        @foreach($branches as $branch)
                        <area class='tooltip' target='_blank' alt='{{$branch->branchName}}' title='{{$branch->branchName}}' href='{{route('branch',['id' => $branch->idBranch])}}' shape='circle'>
                        @endforeach
                    </map>
                    <img src="{{asset('assets/img/map.png')}}" usemap="#phpMap">

                </div>
            </div>
        </div>
    </section>

@stop


@section('footer')


@stop
