<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') - Website Inventory</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- {{ asset('style')}} -->
    <link rel="stylesheet" href="{{ asset('style/vendors/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/vendors/themify-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('style/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/vendors/selectFX/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/style.css') }}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-hZ3oRYXR6-ii0ITh"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><strong>SILIR&nbsp;</strong>Hotel</a>
                <a class="navbar-brand hidden" href="./"><img src="{{ asset('style/images/logo2.png')}}" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ url('admin/history') }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <li>
                        <a href="{{ url('admin/history') }}"> <i class="menu-icon fa fa-plus-square"></i>Add New </a>
                    </li>
                    <li>
                        <a href="{{ url('admin/history') }}"> <i class="menu-icon fa fa-database "></i>History </a>
                    </li>
                    <li>
                        <a href="{{ url('admin/income') }}"> <i class="menu-icon fa fa-line-chart"></i>Income </a>
                    </li>
                    <li>
                        <a href="{{ url('admin/income') }}"> <i class="menu-icon fa fa-book"></i>Room </a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">5</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 3 Notification</p>
                                <a class="dropdown-item media bg-flat-color-1" href="#">
                                    <i class="fa fa-check"></i>
                                    <p>Server #1 overloaded.</p>
                                </a>
                                <a class="dropdown-item media bg-flat-color-4" href="#">
                                    <i class="fa fa-info"></i>
                                    <p>Server #2 overloaded.</p>
                                </a>
                                <a class="dropdown-item media bg-flat-color-5" href="#">
                                    <i class="fa fa-warning"></i>
                                    <p>Server #3 overloaded.</p>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="{{ asset('style/images/admin.jpg')}}" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">

                            <a class="nav-link" href="#"><i class="fa fa-cog"></i> Settings</a>

                            <a class="nav-link" href="#"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>


                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->
        @include('sweetalert::alert')
        @yield('breadcrumbs')

        @yield('content')

    </div><!-- /#right-panel -->

    <!-- Right Panel -->


    <script src="{{ asset('style/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ asset('style/vendors/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{ asset('style/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('style/assets/js/main.js')}} "></script>
    <script src="{{ asset('style/vendors/chart.js/dist/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('js/init-scripts/chart-js/chartjs-init.js') }}"></script>
    <script>
        var rupiah = document.getElementById('rupiah');
        // rupiah.addEventListener('input', function(e) {
        //     // Hilangkan semua karakter non-digit (kecuali titik desimal)
        //     var angka = this.value.replace(/[^\d]/g, '');

        //     // Konversi menjadi angka
        //     var inputNumber = parseFloat(angka);

        //     // Batasi angka maksimal menjadi 50 juta
        //     var maxLimit = 50000000;
        //     if (inputNumber > maxLimit) {
        //         // Jika melebihi batas, ubah nilainya menjadi 50 juta
        //         angka = String(maxLimit);
        //     }

        //     // Format angka menjadi angka rupiah dengan pemisah ribuan
        //     var formatted = formatRupiah(angka);
        //     this.value = formatted;
        // });

        /* Fungsi formatRupiah */
        // function formatRupiah(angka) {
        //     var number_string = angka.replace(/[^,\d]/g, '').toString(),
        //         split = number_string.split(','),
        //         sisa = split[0].length % 3,
        //         rupiah = split[0].substr(0, sisa),
        //         ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        //     // tambahkan titik jika yang di input sudah menjadi angka ribuan
        //     if (ribuan) {
        //         separator = sisa ? '.' : '';
        //         rupiah += separator + ribuan.join('.');
        //     }

        //     rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        //     return rupiah;
        // }

        function validateInput(input) {
            var numericValue = parseInt(input.value);

            // Pastikan nilai input tidak negatif
            if (isNaN(numericValue) || numericValue < 0) {
                // Jika nilai input kosong, bukan angka, atau negatif, set nilai input menjadi 0
                input.value = null;
            } else {
                // Jika nilai input positif, panggil fungsi limitMaxKamar untuk membatasi maksimal 20 kamar
                limitMaxKamar(input);
            }
        }

        function limitMaxKamar(input) {
            // Konversi nilai input menjadi angka
            var jumlahKamar = parseInt(input.value);

            // Batasi maksimal 20 kamar
            var maxKamar = 20;
            if (jumlahKamar > maxKamar) {
                input.value = maxKamar;
            } else if (jumlahKamar <= 0) {
                input.value = "";
            }
        }
    </script>


</body>

</html>