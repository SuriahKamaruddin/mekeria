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

                    <form id="addCategoryForm" class="mb-3" action="{{route('insert-category',['type'=>$type,'id'=>$id])}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="category_name" name="category_name" autofocus value="{{$category->category_name ?? ''}}"
                                required />
                            <label for="category_name">Category Name</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="category_detail" name="category_detail" autofocus value="{{$category->category_description ?? ''}}"
                                required />
                            <label for="category_detail">Category Details</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="file" class="form-control" id="category_img" name="category_img" autofocus />
                            <label for="category_img">Product Image</label>
                        </div>
                        @if($category && !empty($category->category_img))
                        <div class="mb-4">
                            <div class="card" >
                                <img class="card-img-top" src="{{ asset('storage/mekeria/category/' . $category->category_img) }}" alt="Menu Image">

                                <div class="card-body">
                                    <a target_blank href="{{ asset('storage/mekeria/category/' . $category->category_img) }}">File: {{ $category->category_img}}</a>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="form-floating form-floating-outline mb-4">
                                <select class="form-select" id="status" name="status" autofocus required>
                                    <option @if( isset($category)) {{ $category->is_active == 0? 'selected' : '' }} @endif value="0">Inactive</option>
                                    <option @if( isset($category)) {{ $category->is_active == 1? 'selected' : '' }}@else selected @endif value="1">Active</option>
                                </select>
                                <label for="category">Category Status</label>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection