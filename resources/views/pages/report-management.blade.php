@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                @if (Session::has('success'))
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
                            <h5 class="mb-0">Reporting</h5>
                        </div>
                        {{-- <a href="{{ route('add-user-management',['type'=>0,'id'=>0]) }}">
                        <button type="button" class="btn bg-gradient-warning btn-sm mb-0">+&nbsp;Add User</button>
                    </a> --}}
                    </div>
                    <div class="row pt-3">
                        <div class="col-xl-4 mb-3">
                            <label class="form-label">Month</label>
                            <select class="form-select inputCarian" id="month">
                                @foreach ($listOfMonth as $key => $m)
                                    <option @selected($key == $month) value="{{ $key }}">{{ $m }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-4 mb-3">
                            <label class="form-label">Year</label>
                            <select class="form-select inputCarian" id="year">
                                @foreach ($listOfYear as $key => $year)
                                    <option @selected($key == $year) value="{{ $key }}">{{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-4">
                            <label for="form-label">Status</label>
                            <select class="form-select inputCarian" id="status">
                                <option selected>All</option>
                                <option value="0">Cart</option>
                                <option value="1">New Order</option>
                                <option value="2">Preparing</option>
                                <option value="3">Delivered</option>
                                <option value="4">Pickup</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card-body  px-0 pt-0 pb-2">

                    <div class=" p-2">
                        <table id="reporting-table" class="table table-sm table-bordered table-striped table-hover display nowrap">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Customer</th>
                                    <th>Menus</th>
                                    <th>Add On </th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Sub Total</th>
                                    <th>Order Status</th>
                                    <th>Order At</th>
                                    <th>Last Update At</th>
                                </tr>
                            </thead>
                            <tbody class="table-border">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

    <style>
        .dt-buttons {
            margin-bottom: 10px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#reporting-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('reporting_datatable') }}",
                    "data": function(d) {
                        d.month = $('#month').val();
                        d.year = $('#year').val();
                        d.status = $('#status').val();
                    },
                    "type": "GET",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'users.name',
                        name: 'users.name'
                    },
                    {
                        data: 'menus.menus_name',
                        name: 'menus.menus_name'
                    },
                    {
                        data: 'addon_names',
                        name: 'addon_names',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'price_formatted',
                        name: 'price',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'subtotal_formatted',
                        name: 'subtotal',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'status_label',
                        name: 'status_label',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'created_at_formatted',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at_formatted',
                        name: 'updated_at'
                    },
                ]
            });
        });
        console.log($.fn.dataTable.Buttons);
        $(".inputCarian").change(function(e) {
            $('#reporting-table').DataTable().ajax.reload();
        });
    </script>
@endsection
