@extends('layouts.master')
@section('header-content')
    <video muted loop="true" autoplay="autoplay" id="bgvid">
        <source type="video/mp4" src="{{asset('assets/img/banner/home.mp4')}}">
        <!-- <source type="video/webm" src="{{asset('assets/img/header-sliders/header_video.webm')}}"> -->
        Your browser does not support this video type
    </video>
@endsection

<nav>
    <div class="nav-container_test">
        <div class="logo-container">
            <a href="{{route('main')}}" class="logo hvr-grow-rotate"><img src="{{asset('assets/img/logo.png')}}"></a>
        </div>
        <div class = 'shoplogo-container'>
            <img onclick="window.open('https://shop.citihardware.com/')" id = 'imgshop' src="{{asset('assets/img/shop_desktop.jpg')}}">
        </div>
        <div class="menu-container">
            <ul id="menu" class="def">
                <li><a href="{{route('main')}}">Home</a></li>
                <li><a href="{{route('about')}}">About Us</a></li>
                <li><a href="{{route('products')}}">Products</a></li>
                <li><a class="w-nav" href="{{route('featured')}}">Featured Products</a></li>
                <li><a href="{{route('branches')}}">Branches</a></li>
                <li><a href="{{route('careers')}}">Careers</a></li>
                <li><a class="w-nav" href="{{route('news')}}">News &amp; Updates</a></li>
                <li><a class='modalTrigger' id="contactLink" href="">Contact</a></li>
            </ul>
        </div>
        <div class="brger-container">
            <a class="brgericn off" href="javascript:void(0)" onclick="rspnsve()"><i class="fas fa-bars"></i></a>
        </div>
    </div>
</nav>



@section('content')
    <section >
        <div class="featured col-10">
            @foreach($ctlinks as $link)
            <div class="thumbnails"  >
                <aside>
                    <h3 class="thmblabel">{{$link->name}}</h3>
                    <a href="{{route($link->page_link)}}">
                        <div class="imgholder">
                                <!-- <img src="{{asset("assets/img/featured/$link->image")}}"> -->
                            <img src='{{asset("assets/img/featuredwebp")}}/{{preg_replace('/\\.[^.\\s]{3,4}$/', '', $link->image)}}.webp'>
                            <div class="after"></div>
                            <div class="caption">
                                <div class="blur"></div>
                                <div class="caption-text">
                                    <p>{{$link->desc}}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </aside>
            </div>
            @endforeach


        </div>
    </section>
    <hr class="col-10" >
    <section>
        <div class="brands col-10">
            <h1 class="header-text">Our Brands</h1>
            <p class="text">With an increasing portfolio of products sourced from local and international suppliers spanning from Asia, Australia, America, and Europe, CitiHardware continues to serve its customers by providing them with world-class products and a wide variety of the latest construction materials.</p>
            <div class="brandrow">
                <div class="owl-carousel">
                    <!-- check the javascript for on error event code -->
                    @foreach($brands as $brand)
                    <!-- {{$brand->imageFile. ' ' .$brand->brandName.'####'}} -->
                    <div><img src='{{asset("assets/img/brandswebp")}}/{{preg_replace('/\\.[^.\\s]{3,4}$/', '', $brand->imageFile)}}.webp'></div>
                    <!-- {{asset("assets/img/brandswebp")}}/{{basename($brand->imageFile,".jpg")}}.webp -->
                    @endforeach
                </div>

            </div>
        </div>
    </section>
    <section id="aboutus_sction">
        <div class="aboutus col-12">
            <div class="aboutbox white">
                <h1 class="header-text">About Us</h1>
                <p>From its beginnings in 1998, CitiHardware is now one of the leading and fastest growing construction retail stores with {{$totalbranches}} branches in the Philippines.</p>
                <p>At present, CitiHardware continues to lead in offering its customers great value on world-class products sourced from local and international suppliers. Excellent customer service is a top priority in driving customer satisfaction.</p>
                <p>CitiHardware is committed to providing its customers “Great Value Everyday” on products, made from the finest quality materials, at a price you can afford for building projects and home improvement needs.</p>
                <a href="{{route('about')}}" class="btn hvr-bounce-to-right">Read More...</a>
            </div>
        </div>
    </section>
    <section id="branches_sction">
        <div class="branches col-10" >
            <div>
                <h1 class="header-text">Nationwide Network</h1>
                <p class="text">CitiHardware's {{$totalbranches}} stores are strategically located throughout the Philippines' major regions of Luzon, Visayas, and Mindanao and is expected to continuously grow in the coming years.</p>
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
                    <img id = 'imgmap' src="{{asset('assets/img/map.png')}}?={{filemtime('assets/img/map.png')}}" usemap="#phpMap">
                </div>
            </div>
        </div>
    </section>
    <!--  -->
    <span  id = 'messengerlogin'>
        <button onclick = "$('#messengerlogin').hide();" id= 'btnclosemessenger' >.</button>
        <img onclick="window.open('https://www.messenger.com/login.php')" src="{{asset('assets/img/messenger-icon2.png')}}" />
    </span>
    <span  onclick="window.open('https://www.facebook.com/messages/t/271513646288493')" id = 'messengerbutton'>
          <img src="{{asset('assets/img/messenger-icon1.png')}}" />
    </span>


@stop
@section('footer')
@stop
