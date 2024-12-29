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

        .cart-sidebar, .delivery-sidebar {
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

        .cart-sidebar::-webkit-scrollbar, .delivery-sidebar::-webkit-scrollbar {
            width: 8px;
        }

        .cart-sidebar::-webkit-scrollbar-thumb, .delivery-sidebar::-webkit-scrollbar-thumb {
            background-color: #aaa;
            border-radius: 4px;
        }

        .cart-sidebar::-webkit-scrollbar-thumb:hover, .delivery-sidebar::-webkit-scrollbar-thumb:hover {
            background-color: #888;
        }

        .cart-sidebar::-webkit-scrollbar-track, .delivery-sidebar::-webkit-scrollbar-track {
            background-color: #f0f0f0;
        }

        .cart-sidebar.open, .delivery-sidebar.open {
            right: 0;
            /* Slide in */
        }

        .cart-header, .delivery-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            background-color: #333;
            color: white;
        }

        .cart-header, .delivery-header h2 {
            /* font-size: 16px;  */
            margin: 0;
        }

        .close-btn, .delivery-close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
        }

        .close-btn:hover ,.delivery-close-btn:hover{
            color: #ff5c5c;
        }

        .cart-content, .delivery-content {
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

<body class="sub_page">
    <a href="https://wa.me/60199467162" target="_blank" id="whatsapp-button" class="whatsapp-button">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" />
    </a>
    <div class="hero_area">
        <div class="bg-box">
            <img src="{{ asset('assets/img/mekeria_bg_1.jpg') }}" alt="">
        </div>
        <!-- header section strats -->
        <header class="header_section">
            <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="/">
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
                            <li class="nav-item">
                                <a class="nav-link" href="/">Home </a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="menu.html">Menu <span class="sr-only">(current)</span> </a>
                            </li>

                        </ul>
                        <div class="user_option">
                            @if (auth()->check() == true) 
                            <strong class="text-light"> {{auth()->user()->name}}</strong>
                            @else<strong class="text-light">Guest</strong> @endif
                            <a href="@if (auth()->check() == true) {{ url('/logout') }}@else{{ url('/login') }} @endif"
                                class="user_link" id="logout-link">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </a>

                            <a class="cart_link" id="cart-trigger">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 456.029 456.029"
                                    style="enable-background:new 0 0 456.029 456.029;">
                                    <g>
                                        <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                                            c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                                        <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                                            C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                                            c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                                            C457.728,97.71,450.56,86.958,439.296,84.91z" />
                                        <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                                            c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                                    </g>
                                </svg>
                            </a>
                            
                            <div class="cart-sidebar" id="cart-sidebar">
                                <div class="cart-header">
                                    <h2>Your Cart</h2>
                                    <button class="close-btn" id="close-cart">&times;</button>
                                </div>
                                <div class="card mb-3" style="max-width: 540px;">
                                    <div id="cartContainer" class="cart-content row g-0">
                                    </div>
                                </div>
                            </div>
                            
                            <a class="delivery_link" id="delivery-trigger">
                                <i class="fa fa-truck" aria-hidden="true" style="color:#f0f0f0"></i>
                            </a>

                            <div class="delivery-sidebar" id="delivery-sidebar">
                                <div class="delivery-header">
                                    <h2>Delivery & History</h2>
                                    <button class="delivery-close-btn" id="delivery-close-cart">&times;</button>
                                </div>
                                <div class="card mb-3" style="max-width: 540px;">
                                    <div id="deliveryContainer" class="delivery-content row g-0">
                                        @if ($payments->count() > 0)
                                        <div class="card-body">
                                            @foreach ($payments as $payment)            
                                            <div class="card text-dark mb-3 shadow  border border-warning">
                                                <div class="card-header border border-warning" style="background-color:rgb(255, 246, 236);">Payment No: #{{ $payment->id }}</div>
                                                <div class="card-body d-flex flex-column">
                                                <div class="d-flex align-items-center">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <p class="card-text"><small class="text-muted">Date:</small>
                                                                {{$payment->created_at->format('Y-m-d')}}
                                                            </p>
                                                        </div>
                                                        <div class="col-12">
                                                            <p class="card-text"><small class="text-muted">Status:</small>
                                                                @if ($payment->status == 1)
                                                                    Order Confirmed
                                                                @elseif($payment->status == 2)
                                                                    Order is preparing by staff
                                                                @elseif($payment->status == 3)
                                                                    On Deliver by rider
                                                                @elseif($payment->status == 4)
                                                                    Completed
                                                                @else
                                                                    Order Confirmed
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>                             
                                                </div>

                                                    {{-- <div class="row">
                                                        <div class="col-2">
                                                         <p class="card-text"><small class="text-muted">Name</small></p>
                                                        </div>
                                                        <div class="col-10"> <p class="card-text">: <small class="text-dark font-weight-bold">{{$order->users->name}} ({{$order->users->email}})</small></p> 
                                                        </div>
                                                        <div class="col-2">
                                                         <p class="card-text"><small class="text-muted">Pickup/Delivery</small></p>
                                                        </div>
                                                        <div class="col-10"> <p class="card-text">: <small class="text-dark font-weight-bold">@if($order->method_delivery == 1) Pickup at store @else Delivery @endif</small></p> 
                                                        </div>
                                                        @if($order->method_delivery == 2) 
                                                        <div class="col-2">
                                                         <p class="card-text"><small class="text-muted">Address</small></p>
                                                        </div>
                                                        <div class="col-10"> <p class="card-text">: <small class="text-dark font-weight-bold">{{$order->address1}} {{$order->address2}} {{$order->address2}}</small></p> 
                                                        </div>
                                                        <div class="col-2">
                                                         <p class="card-text"><small class="text-muted">Payment Method</small></p>
                                                        </div>
                                                        <div class="col-10"> <p class="card-text">: <small class="text-dark font-weight-bold">@if($order->method_payment == 1) Online @else QR Code @endif</small></p> 
                                                        </div>
                                                        @endif
                                                        <div class="col-2">
                                                         <p class="card-text"><small class="text-muted">Order at</small></p>
                                                        </div>
                                                        <div class="col-10"> <p class="card-text">: <small class="text-dark font-weight-bold">{{ $order->created_at->format('d-m-Y H:m A') }}</small></p> 
                                                        </div>
                                                    </div> --}}
                                                    <div class="d-flex align-items-center">
                                                        <hr class="flex-grow-1">
                                                        <span class="mx-2">Item Details</span>
                                                        <hr class="flex-grow-1">
                                                    </div>
                                                    <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Menus</th>
                                                            <th scope="col">Quantity</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($payment->paymentorder as $paymentorder)
                                                        <tr>
                                                            <th scope="row">
                                                                {{$loop->iteration}}</th>
                                                            <th scope="row">
                                                                {{$paymentorder->order->menus->menus_name}}
                                                            </th>
                                                            <th scope="row">
                                                                {{$paymentorder->order->quantity}}
                                                            </th>
                                                        </tr>     
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot></tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @else
                                            <h5 class="card-title">No records</h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <!-- end header section -->

    </div>

    <!-- food section -->

    <section class="food_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Our Menu
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
                                                @if ($menu->is_sold_out == 0)
                                                    <a class="add-to-cart" data-id="{{ $menu->id }}"
                                                        data-name="{{ $menu->menus_name }}"
                                                        data-description="{{ $menu->menus_description }}"
                                                        data-price="{{ $menu->menus_price }}"
                                                        data-image="{{ $menu->menus_img }}"
                                                        data-addons="{{ json_encode($menu->menus_addons) }}">
                                                        <i class="fa fa-shopping-cart text-light"></i>
                                                    </a>
                                                @else
                                                    <span class="badge bg-danger my-auto">Item Sold Out!</span>
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    <div class="modal fade" id="cart-modal" tabindex="-1" aria-labelledby="cart-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-orange text-light">
                    <h5 class="modal-title" id="cart-modalLabel">Add to cart</h5>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button id="cancel-btn" type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Cancel</button>
                    <button id="add-btn" type="button" class="btn button-orange" data-id="">Add Item</button>
                </div>
            </div>
        </div>
    </div>



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
                                    <img src="//upload.wikimedia.org/wikipedia/commons/thumb/3/34/Ionicons_logo-tiktok.svg/512px-Ionicons_logo-tiktok.svg.png"
                                        alt="TikTok" style="width: 15px; height: 15px;">
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
                    <span id="displayYear"></span>  [DI210004 - Nur Arissya Amalin Binti Ahmad Noorazam Faizal]

                </p>
            </div>
        </div>
    </footer>


    <script src="{{ asset('assets/guest_assets/js/jquery-3.4.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/guest_assets/js/bootstrap.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
    <script src="{{ asset('assets/guest_assets/js/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            displayCart();

        // Check session status every 60 seconds
        const sessionCheckInterval = 60000; // 60 seconds

        setInterval(function () {
            $.ajax({
                url: "{{ route('session.check') }}",
                type: "GET",
                success: function (response) {
                    if (response.status === 'inactive') {
                        // Optional: Handle inactive session if the API provides such info
                        console.log("Session is still active.");
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 401) {
                        // Redirect to the login page if the session has expired
                        window.location.href = "{{ route('destroy') }}";
                    }
                }
            });
        }, sessionCheckInterval);
            $(".add-to-cart").on("click", function(e) {
                const isLoggedIn = $('meta[name="is-logged-in"]').attr('content') === 'true';

                if (!isLoggedIn) {
                    e.preventDefault();
                    window.location.href = "/login";
                    return false;
                }

                const id = $(this).data("id");
                const name = $(this).data("name");
                const price = $(this).data("price");
                const img = $(this).data("image");
                const description = $(this).data("description");

                const imgPath = `/storage/mekeria/menus/${img}`;

                const addons = $(this).data("addons");
                $(".modal-body").empty();

                let addonsHeaderhtml = '';
                let addonshtml = '';
                if (addons.length > 0) {

                    addons.forEach(addon => {
                        addonshtml += `
                        <input class="form-check-input addon-check" type="checkbox" value="${addon.id}" id="addon-${addon.id}">
                        <label class="form-check-label" for="addon-${addon.id}">${addon.name}</label>
                        `;
                    });
                    addonsHeaderhtml = `
                    <li class="list-group-item">
                        <h6 class="card-title">Choose any add-ons</h6>
                        <div class="form-check">
                            ${addonshtml}
                        </div>
                    </li>
                    `;
                }
                //console.log(addonshtml);

                const value = `
                <div class="card">
                    <img src="${imgPath}" class="card-img-top" style="height: 30vh; object-fit: cover;" alt="${name}">
                    <div class="card-body">
                    <h5 class="card-title">${name}</h5>
                    <p class="card-text">
                    ${description}
                    </p>
                    </div>
                    <ul class="list-group list-group-flush">
                    ${addonsHeaderhtml}
                    <li class="list-group-item">
                        <h6 class="card-title">Quantity</h6>
                        <input type="hidden" name="id-${id}" id="id-${id}">
                        <input style="width: 50%;" type="number" id="quantity-${id}" class="form-control" placeholder="Enter quantity" value="1" min="1" max="50">
                    </li>
                    </ul>
                </div>
                `;

                // Set modal content
                $(".modal-body").append(value);
                $("#cart-modalLabel").text(`Add to Cart - ${name}`); // Set modal title dynamically

                $('#add-btn').data('id', id);
                $("#cart-modal").modal("show");

                $('#cancel-btn').click(function() {
                    $('#cart-modal').modal('hide');
                });
            });

            $('#add-btn').click(function() {
                const id = $(this).data('id');
                const quantity = $(`#quantity-${id}`).val();
                
                if (quantity >= 50) {
                    alert('Quantity cannot be more than 50.');
                    return; // Stop further execution
                };

                const addons = [];
                $("input.addon-check:checked").each(function() {
                    // Push the value of each checked checkbox into the addons array
                    addons.push($(this).val());
                });


                // Send data to the controller via AJAX
                $.ajax({
                    url: "{{ route('add_cart') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        quantity: quantity,
                        addons: addons
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#cart-modal').modal('hide');
                            $("#cart-sidebar").addClass("open");
                            displayCart();
                        }
                        else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', error);
                        alert('There was an error processing your request.');
                    }
                });
            });


            $("#cart-trigger").on("click", function() {
                $("#cart-sidebar").addClass("open");
            });

            // Close the cart sidebar when the close button is clicked
            $("#close-cart").on("click", function() {
                $("#cart-sidebar").removeClass("open");
            });

            // Close the sidebar when clicking outside
            $(document).on("click", function(e) {
                if (
                    !$(e.target).closest("#cart-sidebar").length &&
                    !$(e.target).closest("#cart-trigger").length
                ) {
                    $("#cart-sidebar").removeClass("open");
                }
            });

            $("#delivery-trigger").on("click", function() {
                $("#delivery-sidebar").addClass("open");
            });

            // Close the cart sidebar when the close button is clicked
            $("#delivery-close-cart").on("click", function() {
                $("#delivery-sidebar").removeClass("open");
            });

            // Close the sidebar when clicking outside
            $(document).on("click", function(e) {
                if (
                    !$(e.target).closest("#delivery-sidebar").length &&
                    !$(e.target).closest("#delivery-trigger").length
                ) {
                    $("#delivery-sidebar").removeClass("open");
                }
            });
        });

        function displayCart() {
            $.ajax({
                type: "GET",
                url: "{{ route('display_cart') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    
                    // Clear the cart container
                    $('#cartContainer').html('');
                    if (Array.isArray(response) && response.length !== 0) {
                        response.forEach(cart => {
                            let addOnsHtml = '';
                            cart.add_ons.forEach(addon => {
                                addOnsHtml += `
                            <div class="d-flex justify-content-between">
                                <p class="mb-0"><small class="text-muted">${addon.name}</small></p>
                                <p class="mb-0 text-end"><small class="text-muted">RM ${addon.price*cart.quantity}</small></p>
                            </div>`;
                            });
    
                            let cartItemHtml = `
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="/storage/mekeria/menus/${cart.menus_img}" class="img-fluid rounded-start" alt="${cart.menus}">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">${cart.menus}</h5>
                                        <div class="input-group input-group-sm mb-3">
                                            <button class="btn btn-secondary button-minuscart" type="button" data-id="${cart.id}">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="12" width="10.5" viewBox="0 0 448 512">
                                                    <path d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/>
                                                </svg>
                                            </button>
                                            <input id="cartqty${cart.id}" type="number" width="50%" class="form-control" value="${cart.quantity}" min="1" max="50" >
                                            <button class="btn btn-secondary button-pluscart" type="button" data-id="${cart.id}">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="12" width="10.5" viewBox="0 0 448 512">
                                                    <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p class="mb-0"><small class="text-muted">Unit Price</small></p>
                                            <p class="mb-0 text-end"><small class="text-muted">RM ${cart.price}</small></p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p class="mb-0"><small class="text-muted">Subtotal</small></p>
                                            <p class="mb-0 text-end"><small class="text-muted">RM ${cart.subtotal}</small></p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p class="mb-0"><small class="text-muted">Discount</small></p>
                                            <p class="mb-0 text-end"><small class="text-muted">-RM ${cart.discount}</small></p>
                                        </div>
                                        ${addOnsHtml}
                                        <div class="d-flex justify-content-between">
                                            <p class="mb-0"><small class="text-bold">Total</small></p>
                                            <p class="mb-0 text-end"><small class="text-bold">RM ${cart.total}</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
    
                            // Append to cart container
                            $('#cartContainer').append(cartItemHtml);
                        });
                        let checkout_button = `<div class=" d-flex justify-content-start col-md-12">
                                                    <a href="{{ route('add-payment') }}" class="btn btn-success">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="12"
                                                            width="13.5" viewBox="0 0 576 512">
                                                            <path
                                                                d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                                                        </svg>
                                                        Checkout</a>
                                                </div>`;
    
                        $('#cartContainer').append(checkout_button);
                    }else{

                        $('#cartContainer').append('Cart is empty');
                    }


                },
                error: function() {
                    $('#cartContainer').append('Cart is empty');
                }
            });
        }

        $(document).on('click', '.button-pluscart', function() {
            const cartId = $(this).data('id'); // Get cart ID
            const quantityInput = $(`#cartqty${cartId}`); // Reference the input field
            let currentQuantity = parseInt(quantityInput.val(), 10); // Get current quantity
            // Increase the quantity

            if (currentQuantity >= 50) {
                alert('Quantity cannot be more than 50.');
                $(this).prop('disabled', true); // Disable the "Add" button
                return; // Stop further execution
            };

            currentQuantity += 1;
            quantityInput.val(currentQuantity); // Update the input field

            // Call backend to update the quantity
            updateCartQuantity(cartId, currentQuantity);
        });

        // Handle the "minus" button click
        $(document).on('click', '.button-minuscart', function() {
            const cartId = $(this).data('id'); // Get cart ID
            const quantityInput = $(`#cartqty${cartId}`); // Reference the input field
            let currentQuantity = parseInt(quantityInput.val(), 10); // Get current quantity

            if (currentQuantity > 0) {
                currentQuantity -= 1; // Decrease the quantity
                quantityInput.val(currentQuantity); // Update the input field

                // If quantity becomes 0, remove the cart item
                if (currentQuantity === 0) {
                    removeCartItem(cartId);
                } else {
                    // Call backend to update the quantity
                    updateCartQuantity(cartId, currentQuantity);
                }
            }
        });

        // Function to update cart quantity via AJAX
        function updateCartQuantity(cartId, quantity) {
            $.ajax({
                type: "POST",
                url: "/update-cart-quantity", // Backend endpoint to update the quantity
                data: {
                    _token: "{{ csrf_token() }}",
                    cart_id: cartId,
                    quantity: quantity
                },
                success: function(response) {
                    displayCart();
                },
                error: function() {
                    alert('Failed to update quantity.');
                }
            });
        }

        function removeCartItem(cartId) {
            $.ajax({
                type: "POST",
                url: "/remove-cart-item", // Backend endpoint to remove the cart item
                data: {
                    _token: "{{ csrf_token() }}",
                    cart_id: cartId
                },
                success: function(response) {
                    $(`#cartqty${cartId}`).closest('.card').remove(); // Remove the card from UI
                    displayCart();
                },
                error: function() {
                    alert('Failed to remove item.');
                }
            });
        }

        $(document).ready(function () {
            $('#logout-link').on('click', function (e) {
                e.preventDefault(); // Prevent default link behavior
                const targetUrl = $(this).data('url'); // Get the URL from data attribute

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will be logged out of your account.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, log me out!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to the dynamic URL
                        window.location.href = "{{ url('/logout') }}";
                    }
                });
            });
        });

    </script>
</body>

</html>
