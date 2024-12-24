<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="is-logged-in" content="{{ auth()->check() ? 'true' : 'false' }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('assets/img/logos/mekeriaicon.png') }}" type="">

    <title> Mekeria </title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/guest_assets/css/bootstrap.css') }}" />

    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- nice select  -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css"
        integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ=="
        crossorigin="anonymous" />
    <!-- font awesome style -->
    <link href="{{ asset('assets/guest_assets/css/font-awesome.min.css') }}" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/guest_assets/css/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('assets/guest_assets/css/responsive.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .cart-container {
            position: relative;
        }

        .cart-link {
            cursor: pointer;
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }

        .cart-sidebar {
            position: fixed;
            top: 0;
            right: -400px;
            /* Hidden offscreen initially */
            width: 400px;
            height: 100%;
            /* Full height of the viewport */
            background-color: #f9f9f9;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
            transition: right 0.3s ease-in-out;
            z-index: 999;
            overflow-y: auto;
            /* Enable vertical scrolling */
            overflow-x: hidden;
            /* Prevent horizontal scrolling */
        }

        .cart-sidebar::-webkit-scrollbar {
            width: 8px;
        }

        .cart-sidebar::-webkit-scrollbar-thumb {
            background-color: #aaa;
            border-radius: 4px;
        }

        .cart-sidebar::-webkit-scrollbar-thumb:hover {
            background-color: #888;
        }

        .cart-sidebar::-webkit-scrollbar-track {
            background-color: #f0f0f0;
        }

        .cart-sidebar.open {
            right: 0;
            /* Slide in */
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            background-color: #333;
            color: white;
        }

        .cart-header h2 {
            /* font-size: 16px;  */
            margin: 0;
        }

        .close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
        }

        .close-btn:hover {
            color: #ff5c5c;
        }

        .cart-content {
            padding: 20px;
            color: #333;
            font-size: 16px;
        }

        #whatsapp-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            background-color: #25D366;
            /* WhatsApp green */
            border-radius: 50%;
            padding: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        #whatsapp-button img {
            width: 50px;
            height: 50px;
        }

        /* Optional hover effect */
        #whatsapp-button:hover {
            background-color: #128C7E;
            /* WhatsApp darker green */
        }
    </style>
</head>

<body>
    <style>
        .nav-link {
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
            /* Adds a shadow for better readability */
        }

        .nav-link:hover {
            color: #ffd700 !important;
        }

        #whatsapp-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            background-color: #25D366;
            /* WhatsApp green */
            border-radius: 50%;
            padding: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        #whatsapp-button img {
            width: 50px;
            height: 50px;
        }

        /* Optional hover effect */
        #whatsapp-button:hover {
            background-color: #128C7E;
            /* WhatsApp darker green */
        }
    </style>
    <div class="hero_area">
        <a href="https://wa.me/60199467162" target="_blank" id="whatsapp-button" class="whatsapp-button">
            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" />
        </a>
        <div class="bg-box">
            <img src="{{ asset('assets/img/mekeria_bg_1.jpg') }}" alt="">
        </div>
        <!-- header section strats -->
        <header class="header_section">
            <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <span>
                            Mekeria
                        </span>
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class=""> </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav  mx-auto ">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ url('/') }}">Home <span
                                        class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/main-menus') }}">Menu</a>
                            </li>
                        </ul>
                        <div class="user_option">
                            @if (auth()->check() == true) 
                            <strong class="text-light"> {{auth()->user()->name}}</strong>
                            @else<strong class="text-light">Guest</strong> @endif
                            <a href="@if (auth()->check() == true) {{ url('/logout') }}@else{{ url('/login') }} @endif"
                                class="user_link">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </a>
                            <a class="cart_link" href="#">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;"
                                    xml:space="preserve">
                                    <g>
                                        <g>
                                            <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                   c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                   C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                   c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                   C457.728,97.71,450.56,86.958,439.296,84.91z" />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                   c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                                        </g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                </svg>
                            </a>

                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <!-- end header section -->
        <!-- slider section -->
        <section class="slider_section ">
            <div id="customCarousel1" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container ">
                            <div class="row">
                                <div class="col-md-7 col-lg-6 ">
                                    <div class="detail-box">
                                        <h1>
                                            <strong>Selera bersama Mekeria</strong>
                                        </h1>
                                        <p>
                                            Keria adalah sejenis kuih yang diperbuat daripada ubi keledek madu yang
                                            berbentuk seperti donut dan disira dengan gula melaka…
                                            Ingin tahu rasanya macam mana? Boleh order sekarang! </p>
                                        <div class="btn-box">
                                            <a href="{{ url('/main-menus') }}">
                                                Order Now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- end slider section -->
    </div>

    <!-- offer section -->

    <section class="offer_section layout_padding-bottom">
        <div class="offer_container">
            <div class="container ">
                <div class="row">
                    @foreach ($salesItems as $salesItem)
                        <div class="col-md-6  ">
                            <div class="box ">
                                <div class="img-box">
                                    <img src="{{ asset('storage/mekeria/menus/' . $salesItem->menus_img) }}"
                                        alt="{{ $salesItem->menus_name }}">
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        {{ $salesItem->menus_name }}
                                    </h5>
                                    <h6>
                                        <span>{{ $salesItem->discount ?? 0 }}%</span> Off
                                    </h6>
                                    <a href="">
                                        Order Now <svg version="1.1" id="Capa_1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 456.029 456.029"
                                            style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                     c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                     C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                     c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                     C457.728,97.71,450.56,86.958,439.296,84.91z" />
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                     c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                                                </g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- end offer section -->

    <!-- food section -->

    <section class="food_section layout_padding-bottom">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Menu
                </h2>
            </div>

            <ul class="filters_menu">
                <li class="active" data-filter="*">All</li>
                @foreach ($category as $cat)
                    <li data-filter=".cat_{{ e($cat->id) }}">{{ $cat->category_name }}</li>
                @endforeach
            </ul>

            <div class="filters-content">
                <div class="row grid">
                    @foreach ($category as $cat)
                        @foreach ($cat->menus as $menu)
                            <div class="col-sm-6 col-lg-4 all cat_{{ e($menu->category_id) }}">
                                <div class="box">
                                    <div>
                                        <div class="img-box">
                                            <img src="{{ asset('storage/mekeria/menus/' . $menu->menus_img) }}"
                                                alt="{{ $menu->menus_name }}">
                                        </div>
                                        <div class="detail-box">
                                            <h5>
                                                {{ $menu->menus_name }}
                                            </h5>
                                            <p>
                                                {{ $menu->menus_description }}
                                            </p>
                                            <div class="options">
                                                <h6>
                                                    RM{{ number_format($menu->price, 2) }}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>

            <div class="btn-box">
                <a href="{{ url('/main-menus') }}">
                    Click Here to Order
                </a>
            </div>
        </div>
    </section>

    <!-- end food section -->

    <!-- end client section -->

    <!-- footer section -->
    <footer class="footer_section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 footer-col">
                    <div class="footer_contact">
                        <h4>
                            Contact Us
                        </h4>
                        <div class="contact_link_box">
                            <a href="">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span>
                                    Kampung Batu Buruk, Terengganu, Malaysia
                                    Dungun, Terengganu.
                                    Kuala Terengganu, Terengganu, Malaysia
                                </span>
                            </a>
                            <a href="">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <span>
                                    +60199467162
                                </span>
                            </a>
                            <a href="">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <span>
                                    kvgjutasdnbhd@gmail.com
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 footer-col">
                    <div class="footer_detail">
                        <a href="" class="footer-logo">
                            Mekeria
                        </a>
                        <div class="footer_social">
                            <a href="https://www.facebook.com/share/19f4XDG2C5/?mibextid=LQQJ4d">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                            <a href="https://www.instagram.com/mekeria.hq/profilecard/?igsh=bHN0aWtoZjl2dWR0">
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                            </a>
                            <a href="https://www.tiktok.com/@mekeria_batuburuk?_t=8sQmUrrDehs&_r=1">
                                <span class="icon">
                                    <img src="//upload.wikimedia.org/wikipedia/commons/thumb/3/34/Ionicons_logo-tiktok.svg/512px-Ionicons_logo-tiktok.svg.png" alt="TikTok" style="width: 20px; height: 20px;">
                                </span>
                                                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 footer-col">
                    <h4>
                        Opening Hours
                    </h4>
                    <p>
                        Everyday
                    </p>
                    <p>
                        10.00 am - 07.00 pm
                    </p>
                </div>
            </div>
            <div class="footer-info">
                <p>
                    &copy; <span id="displayYear"></span> All Rights Reserved By Mekeria<br><br>
                    &copy; <span id="displayYear"></span> Distributed By Mekeria

                </p>
            </div>
        </div>
    </footer>
    <!-- footer section -->


    <!-- jQery -->
    <script src="{{ asset('assets/guest_assets/js/jquery-3.4.1.min.js') }}"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <!-- bootstrap js -->
    <script src="{{ asset('assets/guest_assets/js/bootstrap.js') }}"></script>
    <!-- owl slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- isotope js -->
    <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
    <!-- nice select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
    <!-- custom js -->
    <script src="{{ asset('assets/guest_assets/js/custom.js') }}"></script>
    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
    </script>
    <!-- End Google Map -->
</body>

</html>
