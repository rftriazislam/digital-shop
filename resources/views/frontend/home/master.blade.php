<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" href="{{ asset('front_end/logo/icon.png') }}">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    @yield('head_link')

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext" rel="stylesheet">
    
    <link rel="stylesheet" href="{{asset('front_end/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{asset('front_end/fonts/Linearicons/Linearicons/Font/demo-files/demo.css') }}">
    <link rel="stylesheet" href="{{asset('front_end/plugins/bootstrap4/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('front_end/plugins/owl-carousel/assets/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{asset('front_end/plugins/slick/slick/slick.css') }}">
    <link rel="stylesheet" href="{{asset('front_end/plugins/lightGallery-master/dist/css/lightgallery.min.css') }}">
    <link rel="stylesheet" href="{{asset('front_end/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css') }}">
    <link rel="stylesheet" href="{{asset('front_end/plugins/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{asset('front_end/plugins/select2/dist/css/select2.min.css') }}">
    <script src="{{asset('front_end/js/country_list/countries.js')}}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    {{-- <link rel="stylesheet" href="css/style.css"> --}}
    <link rel="stylesheet" href="{{asset('front_end/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('front_end/css/electronic.css')}}">

{{-- adsense code --}}
    <script data-ad-client="ca-pub-7495499670814741" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
{{-- adsense code --}}


    <script type="text/javascript">

        console.log('riaz');
    </script>
<style>
.alertMsg{
    display: none;
position: absolute;
padding: 15px;
border: 3px solid #e0dbdb;
left: 0;
z-index: 1;
color:white;
background: var(--green);
border-radius:22px 0px 22px 10px;
}


</style>


</head>

<body>

    @include('frontend.home.page.header')

   
    
       @yield('maincontent')

       @include('frontend.home.page.footer')

    {{-- <div class="ps-popup" id="subscribe" data-time="500">
        <div class="ps-popup__content bg--cover" data-background="{{ asset('front_end/img/bg/subscribe.jpg') }}"><a class="ps-popup__close" href="#"><i class="icon-cross"></i></a>
            <form class="ps-form--subscribe-popup" action="index.html" method="get">
                <div class="ps-form__content">
                    <h4>Get <strong>25%</strong> Discount</h4>
                    <p>Subscribe to the Martfury mailing list <br /> to receive updates on new arrivals, special offers <br /> and our promotions.</p>
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Email Address" required>
                            <button class="ps-btn">Subscribe</button>
                        </div>
                        <div class="ps-checkbox">
                            <input class="form-control" type="checkbox" id="not-show" name="not-show">
                            <label for="not-show">Don't show this popup again</label>
                        </div>
                </div>
            </form>
        </div>
    </div> --}}
    <div id="back2top" style="#0b415e">
        {{-- <i class="pe-7s-angle-up"></i> --}}
        <span class="icon-chevron-up"></span>
    </div>
    <div class="ps-site-overlay"></div>
    <div id="loader-wrapper">
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <div class="ps-search" id="site-search"><a class="ps-btn--close" href="#"></a>
        <div class="ps-search__content">
            <form class="ps-form--primary-search" action="do_action" method="post">
                <input class="form-control" type="text" placeholder="Search for...">
                <button><i class="aroma-magnifying-glass"></i></button>
            </form>
        </div>
    </div>

  @yield('script')
    <script src="{{asset('front_end/plugins/jquery-1.12.4.min.js') }}"></script>
    <script src="{{asset('front_end/plugins/popper.min.js') }}"></script>
    <script src="{{asset('front_end/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{asset('front_end/plugins/bootstrap4/js/bootstrap.min.js') }}"></script>
    <script src="{{asset('front_end/plugins/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{asset('front_end/plugins/masonry.pkgd.min.js') }}"></script>
    <script src="{{asset('front_end/plugins/isotope.pkgd.min.js') }}"></script>
    <script src="{{asset('front_end/plugins/jquery.matchHeight-min.js') }}"></script>
    <script src="{{asset('front_end/plugins/slick/slick/slick.min.js') }}"></script>
    <script src="{{asset('front_end/plugins/jquery-bar-rating/dist/jquery.barrating.min.js') }}"></script>
    <script src="{{asset('front_end/plugins/slick-animation.min.js') }}"></script>
    <script src="{{asset('front_end/plugins/lightGallery-master/dist/js/lightgallery-all.min.js') }}"></script>
    <script src="{{asset('front_end/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{asset('front_end/plugins/sticky-sidebar/dist/sticky-sidebar.min.js') }}"></script>
    <script src="{{asset('front_end/plugins/jquery.slimscroll.min.js') }}"></script>
    <script src="{{asset('front_end/plugins/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{asset('front_end/plugins/gmap3.min.js') }}"></script>
    <!-- custom scripts-->
    <script src="{{asset('front_end/js/main.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxflHHc5FlDVI-J71pO7hM1QJNW1dRp4U&amp;region=GB"></script>



    
    <script src="{{asset('front_end/js/country_list/country.js')}}"></script>

@yield('footer_link')



<script>
    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>

</body>

</html>