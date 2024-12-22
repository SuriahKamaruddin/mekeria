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

  <link rel="shortcut icon" href="{{ asset('assets/img/logos/mekeriaicon.png')}}" type="">

  <title> Mekeria </title>
  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/guest_assets/css/bootstrap.css')}}" />

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <!-- font awesome style -->
  <link href="{{ asset('assets/guest_assets/css/font-awesome.min.css')}}" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="{{ asset('assets/guest_assets/css/style.css')}}" rel="stylesheet" />
  <!-- responsive style -->
  <link href="{{ asset('assets/guest_assets/css/responsive.css')}}" rel="stylesheet" />

</head>

<body class="sub_page">

  <div class="hero_area">
    <div class="bg-box">
      <img src="{{ asset('assets/img/mekeria_bg_1.jpg')}}" alt="">
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

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
              <a href="{{url('/login')}}" class="user_link">
                <i class="fa fa-user" aria-hidden="true"></i>
              </a>

              <a class="cart_link">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;">
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
        @foreach($category as $cat)
        <li data-filter=".cat_{{ e($cat->id) }}">{{$cat->category_name}}</li>
        @endforeach
      </ul>

      <div class="filters-content">
        <div class="row grid">
          @foreach($category as $cat)
          @foreach($cat->menus as $menu)
          <div class="col-sm-6 col-lg-4 all cat_{{ e($menu->category_id) }}">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src="{{ asset('storage/mekeria/menus/' . $menu->menus_img) }}" alt="{{ $menu->menus_name }}">
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
                    <a class="add-to-cart" data-id="{{$menu->id}}" data-name="{{$menu->menus_name}}" data-description="{{$menu->menus_description}}" data-price="{{$menu->menus_price}}" data-image="{{$menu->menus_img}}">
                      <i class="fa fa-shopping-cart text-light"></i>
                    </a>
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
          <button id="cancel-btn" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
                  Location
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Call +01 1234567890
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  mekeria@gmail.com
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
            <p>
              qwertyuiop
            </p>
            <div class="footer_social">
              <a href="">
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-twitter" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-pinterest" aria-hidden="true"></i>
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
            10.00 Am -10.00 Pm
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


  <script src="{{ asset('assets/guest_assets/js/jquery-3.4.1.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="{{ asset('assets/guest_assets/js/bootstrap.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
  <script src="{{ asset('assets/guest_assets/js/custom.js')}}"></script>


  <script>
    $(document).ready(function() {

      $(".add-to-cart").on("click", function(e) {
        e.preventDefault();
        const isLoggedIn = $('meta[name="is-logged-in"]').attr('content') === 'true';

        if (!isLoggedIn) {
          window.location.href = "/login";
          return;
        }

        const id = $(this).data("id");
        const name = $(this).data("name");
        const price = $(this).data("price");
        const img = $(this).data("image");
        const description = $(this).data("description");

        const imgPath = `/storage/mekeria/menus/${img}`;

        $(".modal-body").empty();

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
             <li class="list-group-item">
                <h6 class="card-title">Choose any add-ons</h6>
                <!-- Add multiple checkboxes for different add-ons -->
                <div class="form-check">
                  <input class="form-check-input addon-check" type="checkbox" value="1" id="addon1-${id}">
                  <label class="form-check-label" for="addon1-${id}">Add-on 1</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input addon-check" type="checkbox" value="2" id="addon2-${id}">
                  <label class="form-check-label" for="addon2-${id}">Add-on 2</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input addon-check" type="checkbox" value="3" id="addon3-${id}">
                  <label class="form-check-label" for="addon3-${id}">Add-on 3</label>
                </div>
              </li>
              <li class="list-group-item">
                <h6 class="card-title">Quantity</h6>
                <input type="hidden" name="id-${id}" id="id-${id}">
                <input style="width: 50%;" type="number" id="quantity-${id}" class="form-control" placeholder="Enter quantity" value="1" min="1" max="100">
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
              alert('Item added to cart!');
              $('#cart-modal').modal('hide'); // Close the modal
            } else {
              alert('There was an issue adding the item to the cart.');
            }
          },
          error: function(xhr, status, error) {
            console.error('AJAX error:', error);
            alert('There was an error processing your request.');
          }
        });
      });

    });
  </script>
</body>

</html>
