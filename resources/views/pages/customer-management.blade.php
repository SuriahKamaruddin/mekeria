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
                            <h5 class="mb-0">All Customer</h5>
                        </div>
                      
                    </div>
                </div>

                <div class="card-body  px-0 pt-0 pb-2">
                    <div class="table-responsive p-2">
                        <table class="table text-center table-bordered mb-0" id="tableUser">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>@if($user->status == 1)
                                        <span class="badge bg-success">Active</span>
                                        @else
                                        <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('delete-user-management', ['id' => $user->id]) }}" class="mx-3 delete-link" data-bs-toggle="tooltip" data-bs-original-title="Delete">
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
        $('#tableUser').DataTable({
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
