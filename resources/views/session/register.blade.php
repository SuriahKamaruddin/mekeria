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
                                    <h3 class="" style="color: #4d0e00">Welcome!</h1>
                                </div>
                                <div class="card-body">
                                    <form role="registrationForm" method="POST"
                                        action="{{ route('store', ['role' => 'Customer']) }}">
                                        @csrf
                                        <label>Name</label>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Enter your name" value="" required autofocus />
                                            @error('name')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <label>Phone</label>
                                        <div class="mb-3">
                                            <input type="tel" class="form-control" name="phone" id="phone"
                                                placeholder="Enter your phone number" required autofocus />
                                        </div>
                                        <label>Email</label>
                                        <div class="mb-3">
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Enter your email" value="" required autofocus>
                                            @error('email')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <label>Password</label>
                                       <label for=""><small><i class="text-muted">**Password must be at least 8 characters, including at least 1 uppercase letter, 1 lowercase letter, 1 symbols and 1 number</i></small></label> 
                                        <div class="mb-3">
                                            <div class="md-12 position-relative">
                                                <input type="password" class="form-control" name="password" id="password"
                                                    placeholder="Password" value="" aria-label="Password" aria-describedby="password-addon" required autofocus/>
                                                <button type="button" id="togglePassword" class="position-absolute" 
                                                    style="top: 50%; right: 10px; transform: translateY(-50%); background: none; border: none; padding: 0;">
                                                    <i class="fa fa-eye" id="passwordIcon"></i>
                                                </button>
                                            </div>
                                            @error('password')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="g-recaptcha" style="width: 80%;"
                                            data-sitekey="{{ env('NOCAPTCHA_SITEKEY') }}"></div>
                                        <div id="message-wrap">
                                            <span class="invalid-feedback">
                                            </span>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn button-brown w-100 my-4 mb-2">Register</button>
                                        </div>
                                        <p class="text-sm mt-3 mb-0">Already have an account? <a href="login"
                                                class="text-dark font-weight-bolder">Sign in</a></p>
                                    </form>
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
    <style>
        .button-brown {
        color: white !important;
        background-color: #4d0e00 !important;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
        border: 1px solid #4d0e00; /* Ensure a visible border */
        padding: 10px 20px; /* Adjust padding if needed */
        font-size: 16px; /* Adjust font size if needed */
        text-align: center; /* Ensure text is aligned properly */
        }

        /* Hover state */
        .button-brown:hover {
        background-color: #f28f00 !important;
        color: white !important;
        border-color: #f28f00 !important;
        }
    </style>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        $(document).ready(function () {
            $('#togglePassword').on('click', function () {
                const passwordField = $('#password');
                const passwordIcon = $('#passwordIcon');
    
                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text');
                    passwordIcon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordField.attr('type', 'password');
                    passwordIcon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        });
        function onloadCallback() {
            /* Place your recaptcha rendering code here */
            var response = grecaptcha.getResponse();
            if (response.length == 0) {

                showHideMsg("Please verify reCAPTCHA", "error");
            }
        }

        function showHideMsg(message, type) {
            if (type == "error") {
                event.preventDefault()
                event.stopPropagation()
                $("#message-wrap").removeClass("valid-feedback").addClass("invalid-feedback");
            }

            $("#message-wrap").stop()
                .slideDown()
                .html(message)
                .delay(2500)
                .slideUp();
        }
        var forms = document.querySelectorAll('.needs-validation')
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    onloadCallback();
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    </script>
@endsection
