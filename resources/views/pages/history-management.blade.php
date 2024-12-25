@extends('layouts.user_type.auth')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card mb-4 mx-4">
            <div class="card-header pb-0">
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        <h5 class="mb-0">Completed Orders</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(count($confirmorder) > 0)
                @foreach ($confirmorder as $order)            
                <div class="card text-dark mb-3 shadow  border border-info">
                    <div class="card-header border border-info" style="background-color:rgb(212, 255, 246);">Order ID: {{ $order->id }}</div>
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
                            <div class="col-10"> <p class="card-text">: <small class="text-dark font-weight-bold">{{$order->address1}} {{$order->address2}} {{$order->address2}}, {{$order->postcode}},{{$order->district}}</small></p> 
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
                @endforeach
                @else
                <div class="d-flex align-items-center">
                        <hr class="flex-grow-1">
                        <span class="mx-2">No History Orders</span>
                        <hr class="flex-grow-1">
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
</script>
@endsection