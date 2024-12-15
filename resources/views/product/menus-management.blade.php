@extends('layouts.user_type.auth')

@section('content')
<div>
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
                            <h5 class="mb-0">All Menus</h5>
                        </div>
                        <a href="{{ route('add-product',['type'=>0,'id'=>0]) }}">
                            <button type="button" class="btn bg-gradient-warning btn-sm mb-0">+&nbsp;Add Menus</button>
                        </a>
                    </div>
                </div>
                <div class="card-body  px-0 pt-0 pb-2">
                    <div class="table-responsive p-2">
                        <table class="table text-center table-bordered mb-0" id="tableMenus">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Menus Name</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Unit Price</th>
                                    <th>Active</th>
                                    <th>Sales Status</th>
                                    <th>Sold Out Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0 text-center">
                                @foreach($menus as $menu)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$menu->menus_name}}</td>
                                    <td>{{$menu->category->category_name ?? ""}}</td>
                                    <td>{{$menu->menus_description}}</td>
                                    <td><img class="card-img-top" src="{{ asset('storage/mekeria/menus/' . $menu->menus_img) }}" alt="Menu Image"/></td>
                                    <td>{{$menu->price}}</td>
                                    <td>@if($menu->is_active == 1) <span class="badge bg-success">Active</span>@else<span class="badge bg-danger">Inactive</span> @endif</td>
                                    {{-- <td>@if($menu->is_sale == 1) <span class="badge bg-primary">On sale</span>@else<span class="text-secondary">N/A</span> @endif</td>
                                    <td>@if($menu->is_sold_out == 1) <span class="badge bg-danger">Sold Out</span>@else<span class="text-secondary">N/A</span> @endif</td> --}}
                                    <td>
                                        <a href="{{ route('update-on-sales-product', ['id' => $menu->id, 'is_on_sales' => $menu->is_sale]) }}" class="btn btn-sm {{ $menu->is_sale ? 'btn-success' : 'btn-secondary' }} mx-3 update-on-sales-link" data-on-sales="{{ $menu->is_sale }}">
                                            {{ $menu->is_sale ? 'On Sale' : 'N/A' }}
                                        </a>
                                        {{-- <a href="{{ route('update-sales-product', ['id' => $menu->id]) }}" 
                                            class="btn btn-sm {{ $menu->is_sale ? 'btn-primary' : 'btn-secondary' }}" 
                                            onclick="confirmToggle({{ $menu->id }}, 'is_sale', this)">{{ $menu->is_sale ? 'On Sale' : 'N/A' }}
                                        </a> --}}
                                    </td>
                                    <td>
                                        <a href="{{ route('update-sales-out-product', ['id' => $menu->id, 'is_sold_out' => $menu->is_sold_out]) }}" class="btn btn-sm {{ $menu->is_sold_out ? 'btn-danger' : 'btn-secondary' }} mx-3 update-sales-out-link" data-is-sold-out="{{ $menu->is_sold_out }}">
                                            {{ $menu->is_sold_out ? 'Sold Out' : 'Available' }}
                                        </a>
                                        {{-- <a href="{{ route('update-sales-out-product', ['id' => $menu->id]) }}" 
                                            class="btn btn-sm {{ $menu->is_sold_out ? 'btn-danger' : 'btn-secondary' }}" 
                                            onclick="confirmToggle({{ $menu->id }}, 'is_sold_out', this)">{{ $menu->is_sold_out ? 'Sold Out' : 'N/A' }}
                                        </a> --}}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('add-product',['type'=>1,'id'=>$menu->id]) }}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                            <i class="fas fa-edit text-secondary"></i>
                                        </a>
                                        <a href="{{ route('delete-product', ['id' => $menu->id]) }}" class="mx-3 delete-link" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </a>
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
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#tableMenus').DataTable({
            "language": {
                "paginate": {
                    "previous": "<",
                    "next": ">"
                }
            },
        });
        $('.delete-link').on('click', function(e) {
            e.preventDefault(); // Prevent default link behavior

            let deleteUrl = $(this).attr('href'); // Get the link's href

            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = deleteUrl; // Redirect if confirmed
                }
            });
        });

        
        // $('.update-on-sales-link').on('click', function(e){
        //     e.preventDefault();
        //     let updateOnSalesUrl = $(this).attr('href');
        //     const isOnSales = $(this).attr('data-on-sales') == '1';
        //     const action = isOnSales ? 'mark as not available' : 'mark as on Sales';
        //     const statusText = isOnSales? 'This will mark the product as not available.' : 'This will mark the product as On Sales.';
            
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
        //             window.location.href = updateOnSalesUrl;
        //         }
        //     });
        // });

        $('.update-on-sales-link').on('click', function (e) {
            e.preventDefault();
            let updateOnSalesUrl = $(this).attr('href');
            const isOnSales = $(this).attr('data-on-sales') == '1';
            const action = isOnSales ? 'mark as not available' : 'mark as On Sales';
            const statusText = isOnSales
                ? 'This will mark the product as not available.'
                : 'This will mark the product as On Sales.';

            // Show SweetAlert with conditional input field
            Swal.fire({
                title: `Are you sure you want to ${action}?`,
                html: !isOnSales
                    ? `<p>${statusText}</p><input id="discountInput" type="number" class="swal2-input" placeholder="Enter discount (optional)">`
                    : `<p>${statusText}</p>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Yes, ${action}!`,
                preConfirm: () => {
                    // Return discount input value when "On Sales"
                    return !isOnSales
                        ? { discount: document.getElementById('discountInput').value || 0 }
                        : 0;
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    const discount = result.value?.discount; // Get discount input if provided

                    // Redirect with optional discount parameter
                    if (discount && !isOnSales) {
                        updateOnSalesUrl += `?discount=${encodeURIComponent(discount)}`;
                    }

                    window.location.href = updateOnSalesUrl;
                }
            });
        });

        $('.update-sales-out-link').on('click', function(e){
            e.preventDefault();
            let updateSaleOutsUrl = $(this).attr('href');
            const isSoldOut = $(this).attr('data-is-sold-out') == '1';
            const action = isSoldOut ? 'mark as available' : 'mark as sold out';
            const statusText = isSoldOut? 'This will mark the product as available again.' : 'This will mark the product as sold out.';
            Swal.fire({
                title: `Are you sure you want to ${action}?`,
                text: statusText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Yes, ${action}!`
            }).then((result)=>{
                if(result.isConfirmed){
                    window.location.href = updateSaleOutsUrl;
                }
            });
        });
    });
    // function confirmToggle(event, link) {
    //     event.preventDefault(); // Prevent the default action (navigation)
    //     //console.log(event);
    //     // console.log(link);
    //     // Get the `is_sold_out` value from the data attribute
    //     const isSoldOut = link.getAttribute('data-is-sold-out') == '1'; // Convert to boolean
    //     // console.log(isSoldOut);
    //     // Customize the confirmation message
    //     const action = isSoldOut ? 'mark as available' : 'mark as sold out';
    //     const statusText = isSoldOut 
    //         ? 'This will mark the product as available again.' 
    //         : 'This will mark the product as sold out.';
        
    //     // Show SweetAlert confirmation
    //     Swal.fire({
    //         title: `Are you sure you want to ${action}?`,
    //         text: statusText,
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: `Yes, ${action}!`
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             // If confirmed, navigate to the link's href
    //             window.location.href = link.href;
    //         }
    //     });
    // };
</script>
@endsection