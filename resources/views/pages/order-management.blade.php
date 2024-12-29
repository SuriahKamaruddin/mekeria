@extends('layouts.user_type.auth')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card mb-4 mx-4">
            @if(Session::has('success'))
            <div class="p-3 ">

                <div class="alert alert-success d-flex justify-content-between align-items-center" role="alert">
                    <strong>Success!</strong> {{ Session::get('success', '') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @elseif (Session::has('error'))
            <div class="p-3">

                <div class="alert alert-danger d-flex justify-content-between align-items-center" role="alert">
                    <strong>Failed!</strong> {{ Session::get('error', '') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif

            <div class="card-header pb-0">
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        <h5 class="mb-0">Order Management</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(count($confirmorder) > 0)
                @foreach ($confirmorder as $order)            
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
                        @if($order->status == 2 && $order->method_delivery == 2) 
                        <hr>
                        <div class="row">
                            <div class="col-xl-4 mb-3">
                                <label class="form-label">Choose staff to perform delivering</label>
                                <select class="form-select" id="staff" name="staff">
                                    @foreach ($staff as $key => $s)
                                        <option selected value="{{ $s->name }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif
                        @php
                            $btn = 'btn-secondary';
                            $class = '';
                            $href = '#';

                            if ($order->status == 1) {
                                $btn = 'btn-warning';
                                $class = 'prepare-link';
                                $href = 'update-prepare-order-management';
                                $text ='Prepare Order';
                            } elseif ($order->status == 2) {
                                if ($order->method_delivery == 1) {
                                    $btn = 'btn-success';
                                    $class = 'complete-link';
                                    $href = 'update-complete-order-management';
                                    $text ='Order Pickup and Completed';
                                } else {
                                    $btn = 'btn-primary';
                                    $class = 'deliver-link';
                                    $href = 'update-deliver-order-management';
                                    $text ='Out for Delivery';
                                }
                            } elseif ($order->status == 3) {
                                $btn = 'btn-success';
                                $class = 'complete-link';
                                $href = 'update-complete-order-management';
                                $text ='Order Delivered and Received';
                            }
                        @endphp

                        <a href="{{ $href }}" class="btn {{ $btn }} ms-auto {{ $class }}" data-order-id="{{ $order->id }}" >
                            {{$text}}
                        </a>

                    </div>
                </div>
                @endforeach
                @else
                <div class="d-flex align-items-center">
                        <hr class="flex-grow-1">
                        <span class="mx-2">No Incoming Order</span>
                        <hr class="flex-grow-1">
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#tableOrder').DataTable({
            "language": {
                "paginate": {
                    "previous": "<",
                    "next": ">"
                }
            },
        });
        $('.prepare-link').on('click', function(e) {
            e.preventDefault(); // Prevent default link behavior
            let updateOnSalesUrl = $(this).attr('href');
            let orderId = $(this).data('order-id');
            updateOnSalesUrl += `?id=${orderId}`;
            const statusText = 'Confirm to received order and prepare item.';
            
            Swal.fire({
                title: `Are you sure you want to update?`,
                text: statusText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'Orange',
                cancelButtonColor: 'Grey',
                confirmButtonText: `Confirm`
            }).then((result)=>{
                if(result.isConfirmed){
                    window.location.href = updateOnSalesUrl;
                }
            });
        });

        
        $('.deliver-link').on('click', function(e){
            e.preventDefault();
            let updateOnSalesUrl = $(this).attr('href');
            let orderId = $(this).data('order-id');
            let staffId = $('#staff').val(); 
    
            updateOnSalesUrl += `?id=${orderId}&staff=${staffId}`;
            const statusText = 'Confirm to devliver order.';
            
            Swal.fire({
                title: `Are you sure you want to update?`,
                text: statusText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'Orange',
                cancelButtonColor: 'Grey',
                confirmButtonText: `Confirm`
            }).then((result)=>{
                if(result.isConfirmed){
                    window.location.href = updateOnSalesUrl;
                }
            });
        });

        $('.complete-link').on('click', function(e){
            e.preventDefault();
            let updateOnSalesUrl = $(this).attr('href');
            let orderId = $(this).data('order-id');
            updateOnSalesUrl += `?id=${orderId}`;
            const statusText = 'Order completed.';
            
            Swal.fire({
                title: `Are you sure you want to update?`,
                text: statusText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'Orange',
                cancelButtonColor: 'Grey',
                confirmButtonText: `Confirm`
            }).then((result)=>{
                if(result.isConfirmed){
                    window.location.href = updateOnSalesUrl;
                }
            });
        });

        // $('.update-sales-out-link').on('click', function(e){
        //     e.preventDefault();
        //     let updateSaleOutsUrl = $(this).attr('href');
        //     const isSoldOut = $(this).attr('data-is-sold-out') == '1';
        //     const action = isSoldOut ? 'mark as available' : 'mark as sold out';
        //     const statusText = isSoldOut? 'This will mark the product as available again.' : 'This will mark the product as sold out.';
        //     Swal.fire({
        //         title: `Are you sure you want to ${action}?`,
        //         text: statusText,
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: `Yes, ${action}!`
        //     }).then((result)=>{
        //         if(result.isConfirmed){
        //             window.location.href = updateSaleOutsUrl;
        //         }
        //     });
        // });
    });
</script>
@endsection