<!DOCTYPE html>


<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  @if (env('IS_DEMO'))
  <x-demo-metas></x-demo-metas>
  @endif

  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/logos/mekeriaicon.png">
  <title>
    Mekeria
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css" integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- Popper.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="/DataTables/datatables.min.css" rel="stylesheet">
  <style>
    th {
      text-transform: uppercase;
      color: #6c757d;
      font-size: 0.75rem;
      font-weight: 700;
      opacity: 0.7;
      text-align: center !important;
    }

    table.dataTable tbody tr:last-child td {
      border-right: 1px solid #ddd;
      border-bottom: 1px solid #ddd;
    }

    .sorting_asc,
    .sorting_desc {
      color: #cb0c9f !important;
    }
  </style>

</head>
<body class="g-sidenav-show  bg-gray-100 {{ (\Request::is('rtl') ? 'rtl' : (Request::is('virtual-reality') ? 'virtual-reality' : '')) }} ">


  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/fullcalendar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script src="/DataTables/datatables.min.js"></script>
<div class="row">
    <div class="col-12">
        <div class="card mb-4 mx-4">
            <div class="card-header pb-0">
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        <h5 class="mb-0">Order Details</h5>
                    </div>
                    <td>
                    <button id="print-button" class="btn btn-info" onclick="printReceipt()">
                        <i class="fa fa-print"></i> Print
                    </button>
                    </td>

                    <script>
                        function printReceipt() {
                            const printButton = document.getElementById('print-button');
                            
                            // Hide the button
                            printButton.style.display = 'none';

                            // Trigger print dialog
                            window.print();

                            // Show the button again after printing
                            setTimeout(() => {
                                printButton.style.display = 'inline-block';
                            }, 1000);
                        }
                    </script>
                </div>
            </div>
            <div class="card-body">        
                <div class="card text-dark mb-3 shadow  border border-warning">
                    <div class="card-header border border-warning" style="background-color:rgb(255, 246, 236);">Order ID: {{ $order->id }}</div>
                    <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center">
                        <hr class="flex-grow-1">
                        <span class="mx-2">Customer Details</span>
                        <hr class="flex-grow-1">
                    </div>
                    <div class="row">
                        <div class="col-2">
                         <p class="card-text"><small class="text-muted">Name</small></p>
                        </div>
                        <div class="col-10"> <p class="card-text">: <small class="text-dark font-weight-bold">{{$order->name}} ({{$order->email}})</small></p> 
                        </div>
                        <div class="col-2">
                         <p class="card-text"><small class="text-muted">Phone Number</small></p>
                        </div>
                        <div class="col-10"> <p class="card-text">: <small class="text-dark font-weight-bold">{{$order->contact}}</small></p> 
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
                        <div class="col-10"> <p class="card-text">: <small class="text-dark font-weight-bold">{{$order->address1}} {{$order->address2}} {{$order->address2}}, {{$order->postcode}},{{$order->district}}</small></p> 
                        </div>
                        <div class="col-2">
                         <p class="card-text"><small class="text-muted">Payment Method</small></p>
                        </div>
                        <div class="col-10"> <p class="card-text">: <small class="text-dark font-weight-bold">@if($order->method_payment == 1) Online @else QR Code @endif</small></p> 
                        </div>
                        <div class="col-2">
                         <p class="card-text"><small class="text-muted">Payment Receipt</small></p>
                        </div>
                        <div class="col-10"> <p class="card-text">: <small class="text-dark font-weight-bold"><a href="{{ asset('storage/mekeria/payment/' . $order->payment_img) }}"></a></small></p> 
                        </div>
                        @endif
                        <div class="col-2">
                         <p class="card-text"><small class="text-muted">Order at</small></p>
                        </div>
                        <div class="col-10"> <p class="card-text">: <small class="text-dark font-weight-bold">{{ $order->created_at->format('d-m-Y H:m A') }}</small></p> 
                        </div>
                        @if($order->status == 3 && $order->method_delivery == 2) 
                        <div class="col-2">
                         <p class="card-text"><small class="text-muted">Delivering by</small></p>
                        </div>
                        <div class="col-10"> <p class="card-text">: <small class="text-dark font-weight-bold">{{ $order->deliver_by }}</small></p> 
                        </div>
                        @endif
                        <div class="col-2">
                         <p class="card-text"><small class="text-muted">Completed at</small></p>
                        </div>
                        <div class="col-10"> <p class="card-text">: <small class="text-dark font-weight-bold">{{ $order->updated_at->format('d-m-Y H:m A') }}</small></p> 
                        </div>
                    </div>
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
                                    <th scope="col" style="width: 60px;">Quantity</th>  <!-- Adjust the width here -->
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->paymentorder as $orderdetail)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <th scope="row" class="text-start" style="width: 60%;">{{$orderdetail->order->menus->menus_name}}
                                    
                                    @if($orderdetail->order->addOn)
                                        @foreach ($orderdetail->order->addOn as $addon)
                                        <br> + {{$addon->menusAddon->name}}
                                        @endforeach
                                    @endif
                                    @if($orderdetail->order->menus->is_sale == 1)
                                    <br> Discount ({{$orderdetail->order->menus->discount}}%)
                                    @endif
                                    </th>
                                    <th scope="row">{{$orderdetail->order->quantity}}
                                    @if($orderdetail->order->addOn)
                                        @foreach ($orderdetail->order->addOn as $addon)
                                        <br> {{$orderdetail->order->quantity}}
                                        @endforeach
                                    @endif
                                    </th>
                                    <th scope="row" class="text-end">RM {{ number_format($orderdetail->order->menus->price, 2) }}
                                    @if($orderdetail->order->addOn)
                                        @foreach ($orderdetail->order->addOn as $addon)
                                        <br> RM {{ number_format($addon->menusAddon->price, 2) }}
                                        @endforeach
                                    @endif
                                    </th>
                                    <th  scope="row"  class="text-end">
                                        RM {{ number_format($orderdetail->order->menus->price * $orderdetail->order->quantity, 2) }} <!-- Multiplying price with quantity -->
                                        @if($orderdetail->order->addOn)
                                            @foreach ($orderdetail->order->addOn as $addon)
                                            <br> RM {{ number_format($addon->menusAddon->price * $orderdetail->order->quantity, 2) }} <!-- Add-on price multiplied by quantity -->
                                            @endforeach
                                        @endif
                                        @if($orderdetail->order->menus->is_sale == 1)
                                        <br>- RM {{ number_format($orderdetail->order->discount, 2) }}
                                        @endif
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="row" colspan="4" class="text-end"><strong>Total</strong></th>
                                    <th scope="row" class="text-end">
                                        RM {{ number_format(
                                            $order->paymentorder->sum(function($orderdetail) {
                                                return $orderdetail->order->menus->price * $orderdetail->order->quantity;
                                            }) - ($orderdetail->order->discount ?? 0), 2
                                        ) }}
                                    </th>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
</body>

</html>