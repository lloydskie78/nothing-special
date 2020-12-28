<nav>
    <div class="nav-container">
        <div class="logo-container">
            <a href="{{route('main')}}" class="logo hvr-grow-rotate"><img src="{{asset('assets/img/logo.png')}}"></a>
        </div>
        <div class="shoplogo-container">
            <img onclick="window.open('https://shop.citihardware.com/')" id="imgshop" src="{{asset('assets/img/shop_nav2.jpg')}}">
        </div>
        <div class="lazcontainer">
            <img onclick="window.open('https://www.lazada.com.ph/shop/citihardware-inc')" id="imgshop2" src="{{asset('assets/img/laz_nav.jpg')}}">
        </div>
        <div class="menu-container">
            <ul id="menu" class="def">
                <li><a href="{{route('main')}}">Home</a></li>
                <li><a href="{{route('about')}}">About Us</a></li>
                <li><a href="{{route('products')}}">Products</a></li>
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