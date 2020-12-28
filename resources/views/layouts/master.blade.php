<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="eng">

<head xmlns="http://www.w3.org/1999/xhtml">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description"
        content="From its beginnings as a traditional hardware store in 1976, CitiHardware is now one of the leading and fastest growing construction retail stores with more than 50 branches in the Philippines." />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CITIHARDWARE &middot; The Home Improvement Warehouse</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}">
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}" type="text/css"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.css') }}" type="text/css">
    <!--    OWL CAROUSEL-->
    <link rel="stylesheet" href="{{ asset('assets/css/assets/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/assets/owl.theme.default.min.css') }}" type="text/css">
    <!--    OWL CAROUSEL-->
    <link rel="stylesheet" href="{{ asset('assets/css/iziModal.css') }}" type="text/css">
    <!--iziModal-->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.css') }}" type="text/css">
    <!--fancybox plugin-->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}" type="text/css">
    <!--Jquery UI-->
    <link rel="stylesheet" href="{{ asset('assets/css/hover.css') }}" type="text/css">
    <!--hover plugin-->
    <link rel="stylesheet" href="{{ asset('assets/css/css-loader.css') }}">
    <!--Overlay Loader-->
    <link rel="stylesheet" href="{{ asset('assets/css/balloon.css') }}">
    <!--Balloon Plugin-->
    <link rel="stylesheet" href="{{ asset('assets/css/tooltipster.bundle.min.css') }}">
    <!--Tooltipster Plugin-->
    <link rel="stylesheet" href="{{ asset('assets/css/tooltipster.custom.css') }}">
    <!--Custom Tooltipster Plugin-->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.small-screen.css') }}"
        media="only screen and (max-width: 700px)" type="text/css">
    @yield('styles')
    <script>
        //	IMAGE PLACEHOLDER
        var msg = document.title;
        var speed = 500;
        var endChar = ".. ";
        var pos = 0;

        function moveTitle() {
            var ml = msg.length;

            title = msg.substr(pos, ml) + endChar + msg.substr(0, pos);
            document.title = title;

            pos++;
            if (pos > ml) pos = 0;
            window.setTimeout("moveTitle()", speed);
        }

        moveTitle();

        document.addEventListener("DOMContentLoaded", function(event) {
            document.querySelectorAll('img').forEach(function(img) {
                img.onerror = function() {
                    this.src = '{{ asset('
                    assets / img / error.png ') }}';
                };
            })
        });

    </script>
</head>

<body>
    <!-- Modal structure -->
    <div id="modal"></div>
    <!--End of Modal structure -->

    <div class="loader loader-bar" data-text="" data-rounded data-inverse data-blink></div>
    @include('includes.navigation')
    <div class="container">
        <header>
            <div class="header"
                style="background: #c82333 url('@yield('bg-img')') no-repeat center bottom;background-size: cover;"
                id='bgimgcontainer'>
            </div>
            @yield('header-content')
        </header>
        @yield('content')
    </div>
    @yield('footer')
    <footer>
        <div class="footer col-10 white">
            <div>
                <div>
                    <p><span><strong>Store Support Center
                            </strong></span><br>Quimpo
                        Blvd., Matina, Davao City<br>8000, Philippines</p>
                </div>
            </div>
            <aside id="follow">
                <p>Follow us on:
                <ul class="social">
                    <li><a href="https://www.facebook.com/CitiHardwarePH/" target="_blank"><i
                                class="fab fa-facebook-square"></i></a></li>
                    <li><a href="https://www.instagram.com/citihardware/" target="_blank"><i
                                class="fab fa-instagram"></i></a></li>
                </ul>
            </aside>
            {{--
            <hr class="col-12"> --}}
            <div id="policy">
                <p style="text-align: justify">
                    <span id="imp"><strong> IMPORTANT: </strong></span> CitiHardware and representatives from its store
                    support center will request for your personal data such as but not limited to your name, address and
                    contact details. This request for information is needed in order to address your queries regarding
                    our products, to verify and do necessary preparations to complete your purchase, and to gather
                    feedback in order to improve our services. You may also receive corporate announcements from
                    CitiHardware in line with the products and possible services that you may need from us.
                    <br><br>
                    Privacy Policy
                </p>
            </div>
            <text class="comp">Copyright &copy; <script>
                    document.write(new Date().getFullYear())

                </script> CitiHardware Inc</text>

        </div>
    </footer>

    </div>
    <!--    END WRAPPER -->
    <script src="{{ asset('assets/js/jquery.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}" type="text/javascript"></script>
    <!--OWL CAROUSEL-->
    <script src="{{ asset('assets/js/iziModal.js') }}" type="text/javascript"></script>
    <!--iziModal-->
    <script src="{{ asset('assets/js/jquery.fancybox.pack.js') }}" type="text/javascript"></script>
    <!--fancybox-->
    <script src="{{ asset('assets/js/sweetalert.js') }}" type="text/javascript"></script>
    <!--sweetalert-->
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}" type="text/javascript"></script>
    <!--Jquery UI-->
    <script src="{{ asset('assets/js/mapresizer.js') }}" type="text/javascript"></script>
    <!--Mapresizer plugin-->
    <script src="{{ asset('assets/js/tooltipster.bundle.min.js') }}" type="text/javascript"></script>
    <!--Mapresizer plugin-->
    @stack('scripts')
    <script src="{{ asset('assets/js/scripts.js') }}" type="text/javascript"></script>
    @yield('script')


    <!-- code for the google analytics -->
    <!-- <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-1835968-3']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script> -->
</body>

</html>
