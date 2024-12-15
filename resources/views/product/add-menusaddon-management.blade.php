@extends('layouts.user_type.auth')

@section('content')
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">New Addon Details</h5>
                </div>
                <div class="card-body">

                    <form id="addAddonForm" class="mb-3" action="{{route('insert-menusaddon',['type'=>$type,'id'=>$id])}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="name" name="name" autofocus value="{{$menusaddon->name ?? ''}}"
                                required />
                            <label for="name">Addon Name</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="description" name="description" autofocus value="{{$menusaddon->description ?? ''}}"
                                required />
                            <label for="description">Addon Details</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="number" class="form-control" id="price" name="price" placeholder="Prince" value="{{$menusaddon->price ?? '0'}}" >
                            <label for="price">Unit Price</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <select class="form-select" id="status" name="status" autofocus required>
                                <option @if( isset($category)) {{ $menusaddon->is_active == 0? 'selected' : '' }} @endif value="0">Inactive</option>
                                <option @if( isset($category)) {{ $menusaddon->is_active == 1? 'selected' : '' }}@else selected @endif value="1">Active</option>
                            </select>
                            <label for="category">Status</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('menusaddon-index') }}" type="button" class="btn btn-danger">Exit</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection