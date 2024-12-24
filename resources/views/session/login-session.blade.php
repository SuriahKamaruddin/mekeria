@extends('layouts.user_type.guest')

@section('content')
    <main class="main-content mt-0 mb-2" style="background-color: #f5deb3; width: 100vw; height: 90vh;">
        <section>
            <div class="page-header min-vh-75">

                <div class="container">
                    <div class="row">

                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    @if (Session::has('success'))
                                        <p class="text-dark text-xs mt-2"> {{ Session::get('success', '') }}</p>
                                    @elseif (Session::has('error'))
                                        <p class="text-danger text-xs mt-2"> {{ Session::get('error', '') }}</p>
                                    @endif
                                    <h3 class="font-weight-bolder text-info text-warning">Welcome to Mekeria</h3>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="/session">
                                        @csrf
                                        <label>Email</label>
                                        <div class="mb-3">
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Email" value="admin@admin.com" aria-label="Email"
                                                aria-describedby="email-addon">
                                            @error('email')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Password" value="12345678" aria-label="Password"
                                                aria-describedby="password-addon">
                                            @error('password')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-warning text-dark w-100 mt-4 mb-0">Sign
                                                in</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <small class="text-muted">Forgot you password? Reset you password
                                        <a href="/login/forgot-password"
                                            class="text-info text-dark font-weight-bold">here</a>
                                    </small>
                                    <p class="mb-4 text-sm mx-auto">
                                        Don't have an account?
                                        <a href="register" class="text-info text-dark font-weight-bold">Sign up</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                    style="background-image:url('../assets/img/mekeria.png'); background-position: center; background-repeat: no-repeat; background-size: cover;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
