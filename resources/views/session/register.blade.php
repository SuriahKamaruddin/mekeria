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
                <h3 class="text-dark">Welcome!</h1>
                <p class="text-lead text-dark">Use these awesome forms to login or create new account in your project for free.</p>
              </div>
              <div class="card-body">
                <form role="registrationForm" method="POST" action="{{route('store',['role'=>'Customer'])}}">
                  @csrf
                  <label>Name</label>
                  <div class="mb-3">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Siti Nor Bin Ali" value="" required autofocus/>
                    @error('name')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                  </div>
                  <label>Phone</label>
                  <div class="mb-3">
                    <input type="tel" class="form-control" name="phone" id="phone" placeholder="0123456789" required autofocus/>
                  </div>
                  <label>Email</label>
                  <div class="mb-3">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="" required autofocus >
                    @error('email')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                  </div>
                  <label>Password</label>
                  <div class="mb-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="" required autofocus/>
                    @error('password')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-check form-check-info text-left">
                    <input class="form-check-input" type="checkbox" name="agreement" id="flexCheckDefault" required autofocus/>
                    <label class="form-check-label" for="flexCheckDefault">
                      I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                    </label>
                    @error('agreement')
                      <p class="text-danger text-xs mt-2">First, agree to the Terms and Conditions, then try register again.</p>
                    @enderror
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-warning w-100 my-4 mb-2">Register</button>
                  </div>
                  <p class="text-sm mt-3 mb-0">Already have an account? <a href="login" class="text-dark font-weight-bolder">Sign in</a></p>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
              <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('../assets/img/mekeria.png'); background-position: center; background-repeat: no-repeat; background-size: cover;">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

@endsection

