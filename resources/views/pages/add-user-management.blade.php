@extends('layouts.user_type.auth')

@section('content')

<!-- Basic Layout -->
<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
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

            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">New Staff Details</h5>
            </div>
            <div class="card-body">

                <form id="addUserForm" class="mb-3" action="{{route('insert-user-management',['type'=>$type,'id'=>$id])}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="text" class="form-control" id="name" name="name" value="{{$user->name ?? old('name')}}" autofocus required />
                                <label for="name">Full name</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{$user->email ?? old('email')}}" autofocus required />
                                <label for="email">Email Address</label>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline mb-4">
                                <select class="form-select" id="role" name="role" autofocus required>
                                    <option selected disabled>Choose..</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @if( isset($user->role_id)) {{ $user->role_id == $role->id ? 'selected' : '' }} @endif>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <label for="role">Role</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone ?? old('phone')}}" autofocus required />
                                <label for="phone">Mobile Number</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                    name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" {{ isset($user) ? '' : 'required' }} value="{{old('password') }}" />
                                <label for="password">Password</label>
                            </div>
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="password" id="confirm_password" class="form-control"
                                    name="confirm_password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" {{ isset($user) ? '' : 'required' }}
                                    value="{{ old('confirm_password') }}" />
                                <label for="confirm_password">Confirm Password</label>
                            </div>
                            <span id="match" class="text-danger" style="display: none;">Password
                                did not match</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
        $(document).ready(function() {
            console.log('aaa');
            $('#confirm_password').on('input', function() {
                var password = $('#password').val();
                var confirmPassword = $('#confirm_password').val();

                // Check if passwords match
                if (password != confirmPassword) {
                    $('#match').show();
                } else {
                    $('#match').hide();
                }
            });

            $('#password').keyup(function(e) {
                var password = $('#password').val();
                var confirmPassword = $('#confirm_password').val();
                if (password.length < 5) {
                    $('#match').text('Password must be more than 5 digit');
                    $('#match').show();
                } else if (password != confirmPassword) {
                    $('#match').text('Password does not match');
                    $('#match').show();
                } else {
                    $('#match').hide();
                }
            });

            $("#addUserForm").on("submit", function(event) {
                var password = $('#password').val();
                console.log(password);
                var confirmPassword = $('#confirm_password').val();
                if (password > 0) {
                    if (password.length < 5) {
                        $('#match').text('Password must be more than 5 digit');
                        $('#match').show();
                        event.preventDefault();
                    } else if (confirmPassword.length > 0 && password != confirmPassword) {
                        $('#match').text('Password does not match');
                        $('#match').show();
                        event.preventDefault();
                    } else {
                        $('#match').hide();

                        return true;
                    }
                } else {

                    return true;
                }
            });
        });
    </script>

@endsection
