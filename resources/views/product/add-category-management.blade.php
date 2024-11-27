@extends('layouts.user_type.auth')

@section('content')
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">New Category Details</h5>
                </div>
                <div class="card-body">

                    <form id="addProductForm" class="mb-3" action=""
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="product_name" name="product_name" autofocus
                                required />
                            <label for="product_name">Category Name</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="product_name" name="product_name" autofocus
                                required />
                            <label for="product_name">Category Details</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="file" class="form-control" id="product_img" name="product_img" autofocus
                                required />
                            <label for="product_img">Product Image</label>
                        </div>
                        <div class="row">
                            {{-- <div class="col-12 col-md-2">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="number" step="0.01" id="cost" name="cost" value="0"
                                        class="form-control"autofocus required />
                                    <label for="cost">Cost Price</label>
                                </div>
                            </div> --}}
                            {{-- <div class="col-12 col-md-2">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="number" step="0.01" id="unit_price" name="unit_price" value="0"
                                        class="form-control"autofocus required />
                                    <label for="unit_price">Unit Price</label>
                                </div>
                            </div> --}}
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection