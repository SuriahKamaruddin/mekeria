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

                    <form id="addProductForm" class="mb-3" action="{{route('insert-category')}}"
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="category_name" name="category_name" autofocus
                                required />
                            <label for="category_name">Category Name</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="category_detail" name="category_detail" autofocus
                                required />
                            <label for="category_detail">Category Details</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="file" class="form-control" id="category_img" name="category_img" autofocus />
                            <label for="category_img">Product Image</label>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-2">
                                <div class="form-check form-switch mb-4">
                                    <input class="form-check-input" type="checkbox" role="switch" id="chkStatus" name="chkStatus" />
                                    <label class="form-check-label" for="chkStatus">Status</label>
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