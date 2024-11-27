@extends('layouts.user_type.auth')

@section('content')

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">New Menus Details</h5>
                </div>
                <div class="card-body">

                    <form id="addProductForm" class="mb-3" action="{{route('insert-product')}}"
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="menus_name" name="menus_name" autofocus
                                required />
                            <label for="menus_name">Menu Name</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <textarea id="menus_details" name="menus_details" class="form-control" placeholder="" autofocus
                                required></textarea>
                            <label for="menus_details">Menu Details</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="file" class="form-control" id="menus_img" name="menus_img" autofocus/>
                            <label for="menus_img">Menu Image</label>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-2">
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="number" step="0.01" id="unit_price" name="unit_price" value="0"
                                        class="form-control"autofocus required />
                                    <label for="unit_price">Unit Price</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="form-floating form-floating-outline mb-4">
                                    <select class="form-select" id="category" name="category" autofocus required>
                                        <option selected disabled>Choose..</option>
                                        @foreach ($categorys as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="category">Product Category</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-2">
                                <div class="form-check form-switch mb-4">
                                    <input class="form-check-input" type="checkbox" role="switch" id="chkStatus" name="chkStatus" />
                                    <label class="form-check-label" for="chkStatus">Status</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="form-check form-switch mb-4">
                                    <input class="form-check-input" type="checkbox" role="switch" id="chkSalesItem" name=chkSalesItem />
                                    <label class="form-check-label" for="chkSalesItem">Sales</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="form-check form-switch mb-4">
                                    <input class="form-check-input" type="checkbox" role="switch" id="chkSoldOut" name="chkSoldOut" />
                                    <label class="form-check-label" for="chkSoldOut">Sold Out</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection