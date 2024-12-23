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
                                <select class="form-select" id="sale" name="sale" autofocus required onchange="toggleDiscountInput()">
                                    <option @if( isset($menus)) {{ $menus->is_sale == 0? 'selected' : '' }} @else selected @endif value="0">N/A</option>
                                    <option @if( isset($menus)) {{ $menus->is_sale == 1? 'selected' : '' }} @endif value="1">On Sale</option>
                                </select>
                                <label for="category">Product Sale Status</label>
                            </div>
                        </div>
                        <!-- Discount Amount Input -->
                        <div class="col-12 col-md-3" id="discount-container" style="display: none;">
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="number" class="form-control" id="discount" name="discount" min="0" max="100" placeholder="Discount Amount" value="{{$menus->discount ?? '0'}}" >
                                <label for="discount">Discount Amount (%)</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-3">
                            <div class="form-floating form-floating-outline mb-4">
                                <select class="form-select" id="sold_out" name="sold_out" autofocus required>
                                    <option @if( isset($menus)) {{ $menus->is_sold_out == 0? 'selected' : '' }} @else selected @endif value="0">Available</option>
                                    <option @if( isset($menus)) {{ $menus->is_sold_out == 1? 'selected' : '' }} @endif value="1">Sold Out</option>
                                </select>
                                <label for="category">Product Sold Out Status</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-floating form-floating-outline mb-4">
                                <select class="form-select" id="is_addon" name="is_addon" autofocus required>
                                    <option @if( isset($menus)) {{ $menus->is_addon == 0? 'selected' : '' }} @else selected @endif value="0">N/A</option>
                                    <option @if( isset($menus)) {{ $menus->is_addon == 1? 'selected' : '' }} @endif value="1">Add-On</option>
                                </select>
                                <label for="category">Product has Add-On</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12 col-md-3" id="addon-checkbox-container" style="display: none;">
                            @foreach($menusaddons as $menusaddon)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="addonCheckbox{{ $menusaddon->id }}" name="addonCheckbox[]" value="{{ $menusaddon->id }}"
                                @if(in_array($menusaddon->id, $selectedAddons)) checked @endif>
                                <label class="form-check-label" for="addonCheckbox{{ $menusaddon->id }}">{{ $menusaddon->name }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="file" class="form-control" id="menus_img" name="menus_img" autofocus />
                                <label for="menus_img">Menu Image</label>
                            </div>
                        </div>
                        @if($menus && !empty($menus->menus_img))
                        <div class="col-3">
                            <div class="card" >
                                <img class="card-img-top" src="{{ asset('storage/mekeria/menus/' . $menus->menus_img) }}" alt="Menu Image">

                                <div class="card-body">
                                    <a target_blank href="{{ asset('storage/mekeria/menus/' . $menus->menus_img) }}">File: {{ $menus->menus_img}}</a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('menus-index') }}" type="button" class="btn btn-danger">Exit</a>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        function toggleDiscountInput() {
            const saleDropdown = document.getElementById('sale');
            const discountContainer = document.getElementById('discount-container');
            const discountInput = document.getElementById('discount');

            if (saleDropdown.value === "1") {
                discountContainer.style.display = "block";
                discountInput.setAttribute("required", "required"); // Make it required
            } else {
                discountContainer.style.display = "none";
                discountInput.removeAttribute("required"); // Remove the required attribute
                discountInput.value = ""; // Clear the input value
            }
        }

        document.getElementById('sale').addEventListener('change', toggleDiscountInput);

        toggleDiscountInput();
    });

    document.addEventListener('DOMContentLoaded', function () {
        const isAddonSelect = document.getElementById('is_addon');
        const addonCheckboxContainer = document.getElementById('addon-checkbox-container');

        // Show or hide the checkbox based on the initial value
        function toggleAddonCheckbox() {
            if (isAddonSelect.value === '1') {
                addonCheckboxContainer.style.display = 'block';
            } else {
                addonCheckboxContainer.style.display = 'none';
            }
        }

        // Call toggle function initially
        toggleAddonCheckbox();

        // Add event listener to handle changes
        isAddonSelect.addEventListener('change', toggleAddonCheckbox);
    });

</script>


@endsection