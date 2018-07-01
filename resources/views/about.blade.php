@extends('layouts.master')
@section('bg-img',asset('assets/img/header-sliders/matina.jpg'))
@section('content')
    <div class="aboutcontent col-10">
        <h1 class="header-text">About Us</h1>
        <p>From its beginnings as a traditional hardware store in 1976, CitiHardware is now one of the leading and fastest growing construction retail stores with more than 50 branches in the Philippines.</p>
        <p>At present, CitiHardware continues to lead in offering its customers great value on world-class products sourced from local and international suppliers. Excellent customer service is a top priority in driving customer loyalty and satisfaction.</p>
        <p>CitiHardware is committed to provide its customers “Great Value Everyday” on products, made from the finest quality materials, at a price you can afford for building projects and home improvement needs.</p>
        <hr class="hrline">
        <div>
            <h2>Store Highlights</h2>
            <div class="aboutbody">
                <div class="shlights">
                    <h4 class="shlcontent">Wall and Floor Tiles</h4>
                    <div>
                        <div class="shl_image_container">
                            <img src="{{asset('assets/img/about-us/tiles.jpg')}}">
                        </div>
                        <div>
                            <span class="hlightsdes">Select from an array of tiles that would suit every need. See numerous sizes and designs available of the latest in floor and wall coverings.</span>
                        </div>
                    </div>
                </div>
                <div class="shlights">
                    <h4 class="shlcontent">Bathroom Fixtures</h4>
                    <div>
                        <div class="shl_image">
                            <img src="{{asset('assets/img/about-us/bathroom.jpg')}}">
                        </div>
                        <div>
                            <span class="hlightsdes">Find well-designed bathroom fixtures and accessories that will suit your style and taste.</span>
                        </div>
                    </div>
                </div>
                <div class="shlights">
                    <h4 class="shlcontent">Building Materials</h4>
                    <div>
                        <div class="shl_image">
                            <img src="{{asset('assets/img/about-us/buildingmat.jpg')}}">
                        </div>
                        <div>
                            <span class="hlightsdes">Choose from an extensive assortment of superior quality lumber and woodworks locally produced and imported from New Zealand and the United States that you can use for your home improvement plans.</span>
                        </div>
                    </div>
                </div>
                <div class="shlights">
                    <h4 class="shlcontent">Hardware</h4>
                    <div>
                        <div class="shl_image">
                            <img src="{{asset('assets/img/about-us/hardware.jpg')}}">
                        </div>
                        <div>
                            <span class="hlightsdes">Accomplish do-it-yourself projects for your home with a wide selection of power and construction tools, fasteners such us nails, bolts and screws, and fixtures like locks, hinges and handles.</span>
                        </div>
                    </div>
                </div>
                <div class="shlights">
                    <h4 class="shlcontent">Electrical</h4>
                    <div>
                        <div class="shl_image">
                            <img src="{{asset('assets/img/about-us/electrical.jpg')}}">
                        </div>
                        <div>
                            <span class="hlightsdes">See your home in a new light with different variations of cost effective lighting systems that include devices such as bulbs, wires and switches as well as an assortment of decorative lights.</span>
                        </div>
                    </div>
                </div>
                <div class="shlights">
                    <h4 class="shlcontent">Doors &amp; Mouldings</h4>
                    <div>
                        <div class="shl_image">
                            <img src="{{asset('assets/img/about-us/doors.jpg')}}">
                        </div>
                        <div>
                            <span class="hlightsdes">Make a good impression of your home with doors, windows and mouldings with distinctive design and finish.</span>
                        </div>
                    </div>
                </div>
                <div class="shlights">
                    <h4 class="shlcontent">Appliances</h4>
                    <div>
                        <div class="shl_image">
                            <img src="{{asset('assets/img/about-us/appliances.jpg')}}">
                        </div>
                        <div>
                            <span class="hlightsdes">Choose from an assorment of home appliances for your living space and your kitchen from air con, fans, air coolers to microwave oven, water dispenser, gas range and hobs.</span>
                        </div>
                    </div>
                </div>
                <div class="shlights">
                    <h4 class="shlcontent">Storage and Organizers</h4>
                    <div>
                        <div class="shl_image">
                            <img src="{{asset('assets/img/about-us/storage.jpg')}}">
                        </div>
                        <div>
                            <span class="hlightsdes">Organize your household with our collection of cabinets, clothing racks, shelves and vaults.</span>
                        </div>
                    </div>
                </div>
                <div class="shlights">
                    <h4 class="shlcontent">Outdoor Living</h4>
                    <div>
                        <div class="shl_image">
                            <img src="{{asset('assets/img/about-us/outdoor.jpg')}}">
                        </div>
                        <div>
                            <span class="hlightsdes">Let the family enjoy and relax outdoors with furniture such as chairs and tables that provide excitement and comfort.</span>
                        </div>
                    </div>
                </div>
                <div class="shlights">
                    <h4 class="shlcontent">And more...</h4>
                    <div>
                        <div class="shl_image">
                            <img src="{{asset('assets/img/about-us/andmore.jpg')}}">
                        </div>
                        <div>
                            <span class="hlightsdes">Explore more options such as paints, cleaning materials, floor coverings, doors and mouldings, plumbing, home décor and garden tools that will enhance and give your home a new and better look.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection