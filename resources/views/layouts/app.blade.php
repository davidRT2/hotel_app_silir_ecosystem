<!DOCTYPE html>
<html>

<head>
    <title>Hotel silir</title>
    <link rel="icon" href="img/logo.jpeg" type="image/png">

    <link href="https://fonts.googleapis.com/css?family=Merriweather:300,400|Montserrat:400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="css/icomoon.css">
    <!-- Themify Icons-->
    <link rel="stylesheet" href="css/themify-icons.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="css/bootstrap.css">

    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <!-- Theme style  -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Modernizr JS -->
    <script src="js/modernizr-2.6.2.min.js"></script>
</head>

<body>
    <header>
        <!-- Konten header -->
        <nav>
            <div class="gtco-loader"></div>

            <div id="page">
                <nav class="gtco-nav navbar navbar-fixed-top" role="navigation">
                    <div class="gtco-container">
                        <div class="row">
                            <div class="col-sm-2 col-xs-12">
                                <div id="gtco-logo"><a href="#">Hotel Silir</a></div>
                            </div>
                            <div class="col-xs-10 text-right menu-1">
                                <ul>
                                    <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">Home</a></li>
                                    <li class="{{ Request::is('reservation') ? 'active' : '' }}"><a href="/reservation">Reservation</a></li>
                                    <li class="{{ Request::is('gallery') ? 'active' : '' }}"><a href="/gallery">Gallery</a></li>
                                    <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="/contact">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </nav>
    </header>
    <br>
    <br>
    <div class="content">
        <!-- Konten utama halaman -->
        @yield('content')
    </div>

    @include('layouts.footer')

    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- jQuery Easing -->
    <script src="js/jquery.easing.1.3.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Waypoints -->
    <script src="js/jquery.waypoints.min.js"></script>
    <!-- Carousel -->
    <script src="js/owl.carousel.min.js"></script>

    <!-- Main -->
    <script src="js/main.js"></script>

    <!-- Contact Us-->
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script type="text/javascript">
        jQuery(function($) {
            // Google Maps setup
            var googlemap = new google.maps.Map(
                document.getElementById('googlemap'), {
                    center: new google.maps.LatLng(44.5403, -78.5463),
                    zoom: 8,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
            );
        });
    </script>

</body>