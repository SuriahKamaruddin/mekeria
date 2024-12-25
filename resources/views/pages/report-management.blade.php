@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Reporting</h5>
                        </div>
                    </div>
                    <form method="GET" action="{{ url('reporting') }}">
                        <div class="row pt-3">
                            <!-- Month Filter -->
                            <div class="col-xl-4 mb-3">
                                <label class="form-label">Month</label>
                                <select class="form-select inputCarian" id="month" name="month">
                                    @foreach ($listOfMonth as $key => $m)
                                        <option @selected(request('month') == request('month')) value="{{ $key }}">{{ $m }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Year Filter -->
                            <div class="col-xl-4 mb-3">
                                <label class="form-label">Year</label>
                                <select class="form-select inputCarian" id="year" name="year">
                                    @foreach ($listOfYear as $key => $year)
                                        <option @selected(request('year') == request('year')) value="{{ $key }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Status Filter -->
                            <div class="col-xl-4 mb-3">
                                <label for="form-label">Status</label>
                                <select class="form-select inputCarian" id="status" name="status">
                                    <option @selected(request('status') === null) value="">All</option>
                                    <option @selected(request('status') == '0') value="0">Cart</option>
                                    <option @selected(request('status') == '1') value="1">New Order</option>
                                    <option @selected(request('status') == '2') value="2">Preparing</option>
                                    <option @selected(request('status') == '3') value="3">Delivered</option>
                                    <option @selected(request('status') == '4') value="4">Completed</option>
                                </select>
                            </div>
                        </div>
                        <!-- Update Button -->
                        <div class="row">
                            <div class="col text-end">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="card-body  px-0 pt-0 pb-2">
                    <div class="p-2">
                        <table class="table table-sm text-center table-bordered mb-0" id="tableUser">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Order Details</th>
                                    <th>Customer's Name</th>
                                    <th>Contact No.</th>
                                    <th>Delivery Method</th>
                                    <th>Address</th>
                                    <th>Payment Method</th>
                                    <th>Order Date</th>
                                    <th>Last Update</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                               @foreach($orders as $order)
                                @php
                                        $text ='N/A';
                                        if ($order->status == 1) {
                                            $text ='New Order';
                                        } elseif ($order->status == 2) {
                                                $text ='Order Preparing';
                                        
                                        } elseif ($order->status == 3) {
                                            $text ='Delivering';
                                        }
                                        elseif ($order->status == 4) {
                                            $text ='Completed';
                                        }
                                    @endphp
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td> <a href="{{ route('reporting_receipt', ['id' => $order->id]) }}" target="_blank">
                                            <i class="fa fa-receipt text-info"></i>
                                        </a>
                                    </td>
                                    <td>{{$order->users->name}}</td>
                                    <td>{{$order->users->phone}}</td>
                                    <td>@if($order->method_delivery == 2) Delivery @else Pickup @endif</td>
                                    <td>@if($order->method_delivery == 2){{$order->address1}} {{$order->address2}} {{$order->address3}},{{$order->postcode}},{{$order->district}} @else N/A @endif</td>
                                    <td>@if($order->method_delivery == 2)@if($order->method_payment == 1) Online Banking @else QR @endif @else N/A @endif</td>
                                    <td>{{ $order->created_at->format('d-m-Y H:m A') }}</td>
                                    <td>{{ $order->updated_at->format('d-m-Y H:m A') }}</td>
                                    <td>{{ $text}}</td>
                                    <td> RM {{ number_format(
                                            $order->paymentorder->sum(function($orderdetail) {
                                                return $orderdetail->order->menus->price * $orderdetail->order->quantity;
                                            }) - ($orderdetail->order->discount ?? 0), 2
                                        ) }}
                                    </td>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#tableUser').DataTable({
                scrollX: true,
            "language": {
                "paginate": {
                    "previous": "<",
                    "next": ">"
                }
            },
        });
        });
       
    </script>
@endsection
