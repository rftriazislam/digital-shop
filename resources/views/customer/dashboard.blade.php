<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="apple-touch-icon.png" rel="apple-touch-icon">
    <link href="favicon.png" rel="icon">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('back_end/plugins/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('back_end/fonts/Linearicons/Font/demo-files/demo.css')}}">
    <link rel="stylesheet" href="{{ asset('back_end/plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('back_end/plugins/owl-carousel/assets/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{ asset('back_end/plugins/select2/distt/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('back_end/plugins/summernote/summernote-bs4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('back_end/plugins/apexcharts-bundle/distt/apexcharts.css')}}">
    <link rel="stylesheet" href="{{ asset('back_end/css/style.css')}}">
  
    <script src="{{ asset('back_end/js/jqueryy.js')}}"></script>
  
<style>
 /* define a fixed width for the entire menu */

.navigation {
  width: 300px;
}


/* reset our lists to remove bullet points and padding */

.mainmenu,
.submenu {
  list-style: none;
  padding: 0;
  margin: 0;
}


/* make ALL links (main and submenu) have padding and background color */

.mainmenu a,
.mainmenu label {
  display: block;
  background-color: #f1f2f6;
  text-decoration: none;
  /* padding: 10px; */
  color: #000;
  position: relative;
    display: block;
    padding: 10px 0;
    font-size: 16px;
    font-weight: 400;
    line-height: 20px;
    font-weight: 500;
    text-transform: capitalize;
    transform-style: preserve-3d;
}

.mainmenu label i {
    margin-right: 26px;
}

.mainmenu input {
  display: none;
}


/* add hover behaviour */

.mainmenu a:hover {
  
}


/* when hovering over a .mainmenu item,
  display the submenu inside it.
  we're changing the submenu's max-height from 0 to 200px;
*/


.mainmenu :checked+.submenu {
  display: block;
  max-height: 100%;
}



/*
  we now overwrite the background-color for .submenu links only.
  CSS reads down the page, so code at the bottom will overwrite the code at the top.
*/

.submenu a {
  background-color: #f1f2f6;
}


/* hover behaviour for links inside .submenu */

.submenu a:hover {
  background-color: #993;
}


/* this is the initial state of all submenus.
  we set it to max-height: 0, and hide the overflowed content.
*/

.submenu {
  overflow: hidden;
  max-height: 0;
  -webkit-transition: all 0.5s ease-out;
  background-color: #f1f2f6;
}

.submenu li{
  margin-left: 45px;
}
</style>

</head>

<body>
   @include('customer.pages.header')
        <div class="ps-main__wrapper">
            <header class="header--dashboard">
                <div class="header__left">
                    <h3><a href="{{ route('home') }}">Unistag Home</a></h3>
                   
                </div>
                <div class="header__center">
                    <form class="ps-form--search-bar" action="index.html" method="get">
                        <input class="form-control" type="text" placeholder="Search something">
                        <button><i class="icon-magnifier"></i></button>
                    </form>
                </div>
                {{-- <div class="header__right"><a class="header__site-link" href="#"><span>View your store</span><i class="icon-exit-right"></i></a></div> --}}
            </header>

        @yield('maincontent')
        </div>
    </main>
    <script src="{{ asset('back_end/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('back_end/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('back_end/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('back_end/plugins/jquery.matchHeight-min.js') }}"></script>
    <script src="{{ asset('back_end/plugins/select2/distt/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('back_end/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('back_end/plugins/apexcharts-bundle/distt/apexcharts.min.js') }}"></script>
    <script src="{{ asset('back_end/js/chart.js') }}"></script>
    <!-- custom code-->
    <script src="{{ asset('back_end/js/main.js') }}"></script>
    <script src="{{ asset('back_end/js/jqueryy.js')}}"></script>
    {{-- <script src="www.codermen.com/js/jquery.js"></script> --}}
</body>

</html>