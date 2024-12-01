@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                @if(Session::has('success'))
                <div class="p-3 ">

                    <div class="alert alert-success d-flex justify-content-between align-items-center" role="alert">
                        <strong>Success!</strong> {{ Session::get('message', '') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @elseif (Session::has('error'))
                <div class="p-3">

                    <div class="alert alert-danger d-flex justify-content-between align-items-center" role="alert">
                        <strong>Failed!</strong> {{ Session::get('message', '') }}
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
                                    <td>Img</td>
                                    <td>{{$menu->price}}</td>
                                    <td>@if($menu->is_active == 1) <span class="badge bg-success">Active</span>@else<span class="badge bg-danger">Inactive</span> @endif</td>
                                    <td>@if($menu->is_sale == 1) <span class="badge bg-primary">On sale</span>@else<span class="text-secondary">N/A</span> @endif</td>
                                    <td>@if($menu->is_sold_out == 1) <span class="badge bg-danger">Sold Out</span>@else<span class="text-secondary">N/A</span> @endif</td>
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
    });
</script>
@endsection