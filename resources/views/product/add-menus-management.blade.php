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

                <form id="addProductForm" class="mb-3" action="{{route('insert-product',['type'=>$type,'id'=>$id])}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-floating form-floating-outline mb-4">
                        <select class="form-select" id="category" name="category" autofocus required>
                            <option selected disabled>Choose..</option>
                            @foreach ($categorys as $category)
                            <option value="{{ $category->id }}" @if( isset($menus->category_id)) {{ $menus->category_id == $category->id ? 'selected' : '' }} @endif>{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        <label for="category">Product Category</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="menus_name" name="menus_name" value="{{$menus->menus_name ?? ''}}" autofocus required />
                        <label for="menus_name">Menu Name</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <textarea id="menus_details" name="menus_details" class="form-control" placeholder="" autofocus required>@if( isset($menus)){{$menus->menus_description}}@endif</textarea>
                        <label for="menus_details">Menu Details</label>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="number" step="0.01" id="unit_price" name="unit_price" value="{{$menus->price ?? '0'}}" class="form-control" autofocus required />
                                <label for="unit_price">Unit Price</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-floating form-floating-outline mb-4">
                                <select class="form-select" id="status" name="status" autofocus required>
                                    <option @if( isset($menus)) {{ $menus->is_active == 0? 'selected' : '' }} @endif value="0">Inactive</option>
                                    <option @if( isset($menus)) {{ $menus->is_active == 1? 'selected' : '' }}@else selected @endif value="1">Active</option>
                                </select>
                                <label for="category">Product Status</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-floating form-floating-outline mb-4">
                                <select class="form-select" id="sale" name="sale" autofocus required>
                                    <option @if( isset($menus)) {{ $menus->is_sale == 0? 'selected' : '' }} @endif value="0">N/A</option>
                                    <option @if( isset($menus)) {{ $menus->is_sale == 1? 'selected' : '' }}@else selected @endif value="1">On Sale</option>

                                </select>
                                <label for="category">Product Sale Status</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-floating form-floating-outline mb-4">
                                <select class="form-select" id="sold_out" name="sold_out" autofocus required>

                                    <option @if( isset($menus)) {{ $menus->is_sold_out == 0? 'selected' : '' }} @endif value="0">N/A</option>
                                    <option @if( isset($menus)) {{ $menus->is_sold_out == 1? 'selected' : '' }} @else selected @endif value="1">Sold Out</option>

                                </select>
                                <label for="category">Product Sold Out Status</label>
                            </div>
                        </div>

                    </div>
                    @if($menus)
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="file" class="form-control" id="menus_img" name="menus_img" autofocus />
                                <label for="menus_img">Menu Image</label>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card" >
                                <img class="card-img-top" src="{{ asset('storage/mekeria/menus/' . $menus->menus_img) }}" alt="Menu Image">

                                <div class="card-body">
                                    <a target_blank href="{{ asset('storage/mekeria/menus/' . $menus->menus_img) }}">File: {{ $menus->menus_img}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection