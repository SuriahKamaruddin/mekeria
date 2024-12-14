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
                    {{-- <a href="{{ route('add-user-management',['type'=>0,'id'=>0]) }}">
                        <button type="button" class="btn bg-gradient-warning btn-sm mb-0">+&nbsp;Add User</button>
                    </a> --}}
                </div>
            </div>

            <div class="card-body  px-0 pt-0 pb-2">
                <div class="table-responsive p-2">
                    <table class="table text-center table-bordered mb-0" id="tableUser">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Customer</th>
                                <th>Menus</th>
                                <th>Quantity</th>
                                <th>Update</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $order->users->name }}</td>
                                    <td>{{ $order->menus->menus_name }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>{{ $order->updated_at->format('F j, Y g:i A') }}</td>
                                    <td>
                                        @if ($order->status == 1)
                                            New
                                        @elseif($order->status == 2)
                                            Preparing
                                        @elseif($order->status == 3)
                                            Delivered
                                        @else
                                           N/A
                                        @endif                 
                                    </td>
                                    <td>
                                        @if ($order->status == 1)
                                            <a href="{{ route('update-prepare-order-management', ['id' => $order->id]) }}" class="mx-3 prepare-link" data-bs-toggle="tooltip" data-bs-original-title="Preparing">
                                                <i class="cursor-pointer fa-solid fa-utensils text-secondary"></i>
                                            </a>
                                        @elseif($order->status == 2)
                                            <a href="{{ route('update-deliver-order-management', ['id' => $order->id]) }}" class="mx-3 deliver-link" data-bs-toggle="tooltip" data-bs-original-title="Delivered">
                                                <i class="cursor-pointer fa-solid fa-truck text-secondary"></i>
                                            </a>
                                        @endif 
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
        
        $('.prepare-link').on('click', function(e) {
            e.preventDefault(); // Prevent default link behavior
            let updateOnSalesUrl = $(this).attr('href');
            const statusText = 'This order will be deliver';
            
            Swal.fire({
                title: `Are you sure you want to update?`,
                text: statusText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Yes`
            }).then((result)=>{
                if(result.isConfirmed){
                    window.location.href = updateOnSalesUrl;
                }
            });
        });

        
        $('.deliver-link').on('click', function(e){
            e.preventDefault();
            let updateOnSalesUrl = $(this).attr('href');
            const statusText = 'This order will be deliver';
            
            Swal.fire({
                title: `Are you sure you want to update?`,
                text: statusText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Yes`
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