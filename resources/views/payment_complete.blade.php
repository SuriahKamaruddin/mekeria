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
        /* body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('{{ asset("assets/img/mekeria.png") }}') no-repeat center center fixed;
            background-size: cover;
            position: relative;
        } */
    
        /* Overlay for opacity */
        /* body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: -1; 
        } */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('{{ asset("assets/img/mekeria.png") }}') no-repeat center center fixed;
            background-size: cover;
            display: flex; /* Flexbox for centering */
            align-items: center; /* Center vertically */
            justify-content: center; /* Center horizontally */
            height: 100vh; /* Full viewport height */
        }
        
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Black overlay with 50% opacity */
            z-index: -1; /* Keeps it behind content */
        }
        
        .card {
            background-color: white;
            opacity: 0.9;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 100%;
        }

        h6 {
            margin-bottom: 20px;
            font-size: 18px;
            color: #333;
        }

        .text-danger {
            color: #d9534f;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="card">
        <h2><span class="text-muted fw-light">Thank you for your payment</span></h2>
        <b class="text-danger">**This page will redirect after <span id="timer">0:20</span> minutes. </b>
        <p class="text-warning">
            Please do not close this page. You can make a new order after this.
        </p>
    </div>

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

            const $timerElement = $("#timer");
            const redirectUrl = "{{ route('main_menus') }}"; // Redirect URL when the timer ends
            let remainingTime = 20; // 5 minutes in seconds

            const timerInterval = setInterval(function () {
                const minutes = Math.floor(remainingTime / 60);
                const seconds = remainingTime % 60;
                $timerElement.text(`${minutes}:${seconds < 10 ? '0' : ''}${seconds}`);

                remainingTime--;

                if (remainingTime < 0) {
                    clearInterval(timerInterval);
                    window.location.href = redirectUrl;
                }
            }, 1000);
        });
    </script>
</body>
</html>
