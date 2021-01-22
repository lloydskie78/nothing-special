@extends('layouts.master')
@section('header-content')
<!-- Slideshow container -->
<div class="image-container" id="bgimgcontainer">
    <div class="slideshow-container">
        <!-- Full-width images with number and caption text -->
        <div class="mySlides fade">
            {{-- <div class="numbertext">3 / 3</div> --}}
            <a href="" target="_blank">
                <img src="{{ asset('assets/img/banner/banner_compressed/LUYW Site banners-Website.webp') }}"
                    style="width:100%; height: auto;"
                    onerror="if (this.src != '{{ asset('assets/img/banner/LUYW Site banners-Website.jpg') }}') this.src = '{{ asset('assets/img/banner/LUYW Site banners-Website.jpg') }}';"
                    alt="LUYW Site banner">
            </a>
        </div>
        <div class="mySlides fade">
            {{-- <div class="numbertext">3 / 3</div> --}}
            <a href="" target="_blank">
                <img src="{{ asset('assets/img/banner/banner_compressed/luyw_website banner.webp') }}" style="width:100%; height: auto;"
                    onerror="if (this.src != '{{ asset('assets/img/banner/luyw_website banner.jpg') }}') this.src = '{{ asset('assets/img/banner/luyw_website banner.jpg') }}';"
                    alt="LUYW Site banner bulbs">
            </a>
        </div>
        <div class="mySlides fade">
            {{-- <a href=""> --}}
            {{-- <div class="numbertext">2 / 3</div> --}}
            <img src="{{ asset('assets/img/banner/banner_compressed/digos_facade.webp') }}" style="width:100%; height: auto;"
                onerror="if (this.src != '{{ asset('assets/img/banner/digos_facade.jpg') }}') this.src = '{{ asset('assets/img/banner/digos_facade.jpg') }}';"
                alt="Digos Branch">
            {{-- </a> --}}
        </div>
        <div class="mySlides fade">
            {{-- <a href=""> --}}
            {{-- <div class="numbertext">3 / 3</div> --}}
            <img src="{{ asset('assets/img/banner/banner_compressed/mass_display.webp') }}" style="width:100%; height: auto;"
                onerror="if (this.src != '{{ asset('assets/img/banner/mass_display.jpg') }}') this.src = '{{ asset('assets/img/banner/mass_display.jpg') }}';"
                alt="Mass Display">
            {{-- </a> --}}
        </div>
        <div class="mySlides fade">
            {{-- <a href=""> --}}
            {{-- <div class="numbertext">3 / 3</div> --}}
            <img src="{{ asset('assets/img/banner/banner_compressed/05_shop  go_lazada_webshop.webp') }}"
                style="width:100%; height: auto;"
                onerror="if (this.src != '{{ asset('assets/img/banner/05_shop & go_lazada_webshop.jpg') }}') this.src = '{{ asset('assets/img/banner/05_shop & go_lazada_webshop.jpg') }}';"
                alt="Shop & Go Red">
            {{-- </a> --}}
        </div>
        <div class="mySlides fade">
            <a href="https://www.lazada.com.ph/shop/citihardware-inc/" target="_blank">
                {{-- <div class="numbertext">1 / 3</div> --}}
                <img src="{{ asset('assets/img/banner/banner_compressed/citi_lazada.webp') }}" style="width:100%; height: auto;"
                    onerror="if (this.src != '{{ asset('assets/img/banner/citi_lazada.jpg') }}') this.src = '{{ asset('assets/img/banner/citi_lazada.jpg') }}';"
                    alt="CitiHardware Lazada">
            </a>
        </div>
        <div class="mySlides fade">
            <a href="https://docs.google.com/forms/d/e/1FAIpQLSf00Zm2l15FsTkghkQDf5Gln-eTXuevAwPdIgyUKSKvzR3WHg/viewform"
                target="_blank">
                {{-- <div class="numbertext">3 / 3</div> --}}
                <img src="{{ asset('assets/img/banner/banner_compressed/07_shopgo.webp') }}" style="width:100%; height: auto;"
                    onerror="if (this.src != '{{ asset('assets/img/banner/07_shop&go.jpg') }}') this.src = '{{ asset('assets/img/banner/07_shop&go.jpg') }}';"
                    alt="Shop & Go Yellow">
            </a>
        </div>
        <div class="mySlides fade">
            <a href="https://shop.citihardware.com/" target="_blank">
                {{-- <div class="numbertext">3 / 3</div> --}}
                <img src="{{ asset('assets/img/banner/banner_compressed/02_order now.webp') }}" style="width:100%; height: auto;"
                    onerror="if (this.src != '{{ asset('assets/img/banner/02_order now.jpg') }}') this.src = '{{ asset('assets/img/banner/02_order now.jpg') }}';"
                    alt="Order now">
            </a>
        </div>
        <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>
    <!-- The dots/circles -->
    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
        <span class="dot" onclick="currentSlide(4)"></span>
        <span class="dot" onclick="currentSlide(5)"></span>
        <span class="dot" onclick="currentSlide(6)"></span>
        <span class="dot" onclick="currentSlide(7)"></span>
        <span class="dot" onclick="currentSlide(8)"></span>
    </div>
</div>
@endsection

@section('content')
<section>
    <div class="featured col-10">
        @foreach ($ctlinks as $link)
        <div class="thumbnails">
            <aside>
                <h3 class="thmblabel">{{ $link->name }}</h3>
                <a href="{{ $link->page_link }}" target="_blank">
                    <div class="imgholder">
                        <!-- <img src="{{ asset("assets/img/featured/$link->image") }}"> -->
                        <img
                            src='{{ asset('assets/img/featuredwebp') }}/{{ preg_replace('/\\.[^.\\s]{3,4}$/', '', $link->image) }}.webp'>
                        <div class="after"></div>
                        <div class="caption">
                            <div class="blur"></div>
                            <div class="caption-text">
                                <p class="text">{{ $link->desc }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </aside>
        </div>
        @endforeach
    </div>
</section>
<hr class="col-10">
<section>
    <div class="brands col-10">
        <h1 class="header-text">Our Brands</h1><br>
        <p class="text" style="text-align: justify">With an increasing portfolio of products sourced from local and
            international suppliers spanning from Asia, Australia, America, and Europe, CitiHardware continues to serve
            its customers by providing them with world-class products and a wide variety of the latest construction
            materials.</p>
        <div class="brands_slider_container">
            <div class="owl-carousel owl-theme brands_slider">
                <!-- check the javascript for on error event code -->
                @foreach ($brandSpecific as $brand)
                <!-- {{ $brand->imageFile . ' ' . $brand->brandName . '####' }} -->
                <div class="owl-item">
                    <div class="brands_item d-flex flex-column justify-content-center">
                        <img
                            src='{{ asset('assets/img/brandswebp/wishlist') }}/{{ preg_replace('/\\.[^.\\s]{3,4}$/', '', $brand->imageFile) }}.webp'>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<section id="aboutus_sction">
    <div class="aboutus col-12">
        <div class="aboutbox white">
            <h1 class="header-text">About Us</h1><br>
            <p class="text" style="text-align: justify">From its beginnings in 1998, CitiHardware is now one of the
                leading and fastest growing construction retail stores with {{ $branchesCount }} branches in the
                Philippines.</p>
            <p class="text" style="text-align: justify">At present, CitiHardware continues to lead in offering its
                customers great value on world-class products sourced from local and international suppliers. Excellent
                customer service is a top priority in driving customer satisfaction.</p>
            <p class="text" style="text-align: justify">CitiHardware is committed to providing its customers “Great
                Value Everyday” on products, made from the finest quality materials, at a price you can afford for
                building projects and home improvement needs.</p>
            <a href="{{ route('about') }}" class="btn hvr-bounce-to-right">Read More...</a>
        </div>
    </div>
</section>
<section id="branches_sction">
    <div class="branches col-10">
        <div>
            <h1 class="header-text">Nationwide Network</h1><br>
            <p class="text"
                style="text-align: justify"">CitiHardware's {{ $branchesCount }} stores are strategically located throughout the Philippines' major regions of Luzon, Visayas, and Mindanao and is expected to continuously grow in the coming years.</p>
                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                    <div class="
                maprow">
                <div class="left">
                    <div>
                        <div class="places">
                            <ul class="luz">
                                <li>Luzon</li>
                                @foreach ($luz as $l_branch)
                                <li><a class='indiv_branch hvr-grow'
                                        href='{{ route('branch', ['id' => $l_branch->idBranch]) }}'>{{ $l_branch->branchName }}</a>
                                </li>
                                @endforeach
                            </ul>

                            <ul class="vis">
                                <li>Visayas</li>
                                @foreach ($vis as $v_branch)
                                <li><a class='indiv_branch hvr-grow'
                                        href='{{ route('branch', ['id' => $v_branch->idBranch]) }}'>{{ $v_branch->branchName }}</a>
                                </li>
                                @endforeach
                            </ul>
                            <ul class="min">
                                <li>Mindanao</li>
                                @foreach ($min as $m_branch)
                                <li><a class='indiv_branch hvr-grow'
                                        href='{{ route('branch', ['id' => $m_branch->idBranch]) }}'>{{ $m_branch->branchName }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <map name="phpMap">
                        @foreach ($branches as $branch)
                        <area class='tooltip' target='_blank' alt='{{ $branch->branchName }}'
                            title='{{ $branch->branchName }}' href='{{ route('branch', ['id' => $branch->idBranch]) }}'
                            shape='circle'>
                        @endforeach
                    </map>
                    <img id='imgmap' src="{{ asset('assets/img/map.png') }}?={{ filemtime('assets/img/map.png') }}"
                        usemap="#phpMap">
                </div>
        </div>
    </div>
</section>

<span id='messengerlogin'>
    <button onclick="$('#messengerlogin').hide();" id='btnclosemessenger'>.</button>
    <img onclick="window.open('https://www.messenger.com/login.php')"
        src="{{ asset('assets/img/messenger-icon2.png') }}" />
</span>
{{-- <span onclick="window.open('https://www.facebook.com/messages/t/271513646288493')"
        id='messengerbutton'>
        <img src="{{ asset('assets/img/messenger-icon1.png') }}" />
</span> --}}
<span onclick="messengerToggle()" id='messengerbutton'>
    <img src="{{ asset('assets/img/messenger-icon1.png') }}" />
</span>
<span id="chatus">
    Chat with us!
</span>



@stop
@section('footer')
@stop