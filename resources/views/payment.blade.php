<!-- resources/views/payment/form.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Site Metas -->
     <meta name="keywords" content="" />
     <meta name="description" content="" />
     <meta name="author" content="" />
     <meta name="is-logged-in" content="{{ auth()->check() ? 'true' : 'false' }}">
 
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
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('{{ asset("assets/img/mekeria.png") }}') no-repeat center center fixed;
            background-size: cover;
            position: relative;
        }
    
        /* Overlay for opacity */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Black overlay with 50% opacity */
            z-index: -1; /* Keeps it behind content */
        }
    </style>
</head>
<body>
    {{-- {{ route('order-payment', ['id' => $customer->id]) }} --}}
    <form id="formAuthentication" class="mb-3" action="{{ route('order-payment', ['id' => $user->id]) }}"
        enctype="multipart/form-data" method="POST">
        @csrf
        {{-- {{ $customer->id }} --}}
        <input type="hidden" name="user_id" id="user_id" value="">
        {{-- <input type="hidden" name="order_id" id="order_id" value="{{ $order->id }}"> --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card w-75 h-100 mx-auto py-2" style="opacity: 90%">
                    <h6 class="p-2 mb-4"><span class="text-muted fw-light">Checkout/</span> Customer Details</h6>
                    <div class="row gy-4 p-4">
                        <div class="col-12">
                            <div class="row align-item-center gy-4">
                                <div class="col-12 col-md-6">
                                    <div>
                                        <p>Delivery Method</p>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="radioDeliveryMethod"
                                                id="radioDeliveryMethod1" value="1">
                                            <label class="form-check-label" for="radioDeliveryMethod1">
                                                Pickup
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="radioDeliveryMethod"
                                                id="radioDeliveryMethod2" value="2" checked>
                                            <label class="form-check-label" for="radioDeliveryMethod2">
                                                Delivery
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="col-12 col-md-12">
                                    <p>Customer Details</p>
                                    <table id="orderTable" class="table table-bordered">
                                        <thead>
                                            {{-- <tr>
                                                    <th scope="col">#Order Id: </th>
                                                    <th scope="col" colspan="3"><span
                                                            id="order_id">{{ $order->id }}</span>
                                                    </th>
                                                </tr> --}}
                                            <tr>
                                                <th scope="col">Customer Name: </th>
                                                <th scope="col" colspan="3">
                                                    {{-- {{ $customer->user_details->fname . ' ' . $customer->user_details->lname }} --}}
                                                    <input type="text" id="customer_name" name="customer_name"
                                                        value="{{$user->name}}"
                                                        class="form-control" autofocus required />
                                                </th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Customer Address: </th>
                                                <th scope="col" colspan="3">
                                                    {{-- <input type="text" id="customer_address" name="customer_address"
                                                        value="{{ $customer->user_details->address_1 . ' ' . $customer->user_details->address_2 }}"
                                                        class="form-control" required /> --}}

                                                        <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-floating form-floating-outline mb-3">
                                                                    {{-- {{ $customer->user_details->address_1 }} --}}
                                                                    <input type="text" class="form-control form-control-sm" id="address_1"
                                                                        name="address_1" placeholder="Enter your address"
                                                                        value="" autofocus required>
                                                                    <label for="address_1">Address 1 <span class="text-danger">*</span></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-floating form-floating-outline mb-3">
                                                                    <input type="text" class="form-control form-control-sm" id="address_2"
                                                                        name="address_2" placeholder="Enter your address"
                                                                        value=""  autofocus required>
                                                                    <label for="address_2">Address 2</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-floating form-floating-outline mb-3">
                                                                    <input type="text" class="form-control form-control-sm" id="address_3"
                                                                        name="address_3" placeholder="Enter your address"
                                                                        value=""  autofocus required>
                                                                    <label for="address_2">Address 3</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-floating form-floating-outline mb-3">
                                                                    <div class="form-floating form-floating-outline">
                                                                        <input type="text" class="form-control form-control-sm" id="postcode"
                                                                        name="postcode" placeholder="Postcode"
                                                                        value=""  autofocus>
                                                                        <label for="postcode">Postcode<span class="text-danger">*</span></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <div class="form-floating form-floating-outline mb-3">
                                                                    <div class="form-floating form-floating-outline">
                                                                        <input type="text" class="form-control form-control-sm" id="district"
                                                                        name="district" placeholder="District"
                                                                        value=""  autofocus>
                                                                        <label for="district">District<span class="text-danger">*</span></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Customer Contact: </th>
                                                <th scope="col" colspan="3">
                                                    {{-- {{$customer->user_details->contact_no}} --}}
                                                    <input type="text" id="customer_contact" name="customer_contact"
                                                         class="form-control" value="{{$user->phone}}" autofocus required />

                                                    <span style="display: none;" id="validate_contact"
                                                        class="text-danger text-capitalize">Phone number must be at
                                                        least 10 digits.</span>

                                                </th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Email Address: </th>
                                                <th scope="col" colspan="3">
                                                    {{-- {{$customer->user_details->contact_no}} --}}
                                                    <input type="email" id="email" name="email"
                                                         class="form-control" value="{{$user->email}}" autofocus required />
                                                </th>
                                            </tr>
                                        </thead>

                                    </table>

                                    <hr>
                                    <p>Order Items</p>
                                    <table id="orderTable2" class="table table-bordered pt-2">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Remark</th>
                                                <th>Quantity</th>
                                                <th>Sub Total</th>
                                            </tr>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <th>{{ $loop->iteration }} </th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    {{-- <th>{{ $item->product->product_name }} ({{ $item->weight->description }})</th>
                                                    <th>{{ $item->product_qty }} </th>
                                                    <th>{{ $item->sub_total }}</th> --}}
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th colspan="2"></th>
                                                <th> Total Amount</th>
                                                {{-- {{ number_format($customer->user_details->uPostcode->delivery_fee+$cart->sum('sub_total') ?? 0, 2) }} --}}
                                                <th> 
                                                    <span
                                                    name="total_amount_span" id="total_amount_span"></span>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                    {{-- {{ number_format($cart->sum('sub_total')  ?? 0, 2) }} --}}
                                    <input type="hidden" name="total_amount"
                                        value="">
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-12 pt-2">

                <div class="card w-75 h-100 mx-auto py-2" style="opacity: 90%">
                    <h6 class="p-2 mb-4"><span class="text-muted fw-light">Checkout/</span> Payment Details</h6>
                    <div class="row gy-4 p-4">
                        <div class="col-12">
                            <div class="row align-item-center gy-4">
                                <div class="col-12 col-md-12">
                                    <div id="transfer">
                                        <p class="text-danger"> <small><i>**Kindly transfer to the account below and attach the receipt.</i> </small></p>
                                        <div class="card border" style="width: 100%;">
                                            <div class="card-header">

                                                <div class="form-check">
 //display qr
                                                

                                                    <label class="form-check-label" for="radioPaymentMethod1">
                                                        <b>12345678890</b> <b>(Mekeria Bank Account)</b>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="qr" class="mx-auto" style="display: none">
                                        <p class="text-danger"> <small><i>**Kindly scan the QR below and attach the receipt.</i> </small></p>
                                        <img src="{{ asset('assets/img/elements/qr.jpeg') }}" width="250" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="row py-3">
                                <div class="col-md-12">
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input type="file" class="form-control" id="payment_receipt"
                                            name="payment_receipt" autofocus required />
                                        <label for="payment_receipt">Payment Receipt</label>
                                    </div>
                                </div>

                            </div>
                            <div class="row justify-content-end">
                                <div class="col-auto">
                                    <button id="completeModal" type="submit" class="btn btn-sm btn-primary">
                                        Proceed Payment
                                    </button>
                                    {{-- <a href="{{ route('dashboard-customer') }}">
                                        <button id="completeModal" type="button" class="btn btn-sm btn-danger">
                                            Cancel
                                        </button>
                                    </a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

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
    <script>
        $(document).ready(function(){

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
                            window.location.href = "{{ route('login') }}";
                        }
                    }
                });
            }, sessionCheckInterval);
            $('input[name="radioDeliveryMethod"]').change(function() {
                if($(this).val() === '1'){
                    $('input[type="text"], input[type="number"], input[type="checkbox"], input[type="email"], input[type="file"], select, textarea').prop('disabled', true);
                }else{
                    $('input[type="text"], input[type="number"], input[type="checkbox"], input[type="email"], input[type="file"], select, textarea').prop('disabled', false);
                }
            });
        });
    </script>
</body>
</html>
