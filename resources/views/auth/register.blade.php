@extends('auth.master')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <img src="{{ asset('images/logo.png') }}" style="width:100%;height:auto">
            </div>
            <div class="col-md-6 rounded-5">
                <div class="card" style="border-radius: 20px">
                    <div class="card-body">
                        <h3 class="login-box-msg">{{ __('Register') }}</h3>

                        <div class="input-group mb-3">
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('Name') }}"
                                required autocomplete="name" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @error('name')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Email') }}"
                                required autocomplete="email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                                @error('email')
                                    <span class="error invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="phone_number" id="phone_number"
                                class="form-control @error('phone_number') is-invalid @enderror"
                                placeholder="{{ __('Phone Number') }}" required autocomplete="phone_number">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone"></span>
                                </div>
                            </div>
                            @error('phone_number')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="{{ __('Password') }}" required autocomplete="new-password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="error invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            <label class="form-label fw-500 d-none" id="error-message-register"
                                style="color: #EE3C3B;"></label>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" id="register"
                                    class="btn btn-primary btn-block">{{ __('Register') }}</button>
                            </div>
                        </div>

                        <div class="col-12">
                            <!-- Google login button -->
                            <div class="text-center mt-3">
                                <a href="{{ route('google-auth') }}" class="btn btn-danger btn-block">
                                    <i class="fab fa-google mr-2"></i>Continue with Google
                                </a>
                            </div>
                            <!-- /.social-auth-links -->
                        </div>

                        <hr>
                        <p class="mb-0">
                            Already have an account? <a href="{{ route('login') }}">{{ __('Sign in') }}</a>
                        </p>

                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('library')
        <script type="text/javascript">
            $(document).ready(function() {
                $("#register").click(function(e) {
                    e.preventDefault();
                    var name = $("#name").val();
                    var email = $("#email").val();
                    var phone_number = $("#phone_number").val();
                    var password = $("#password").val();
                    var password_confirmation = $("#password_confirmation").val();

                    if (password !== password_confirmation) {
                        $('#error-message-register').removeClass('d-none').text(
                            "{{ __('Passwords do not match') }}");
                        return;
                    }

                    var formData = new FormData();
                    formData.append('name', name);
                    formData.append('email', email);
                    formData.append('phone_number', phone_number);
                    formData.append('password', password);
                    formData.append('password_confirmation', password_confirmation);

                    $.ajax({
                        type: "POST",
                        url: "{{ env('URL_API') }}/api/v1/auth/register",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(resultLogin) {
                            $.ajax({
                                type: "POST",
                                url: "{{ route('session.register') }}",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    guid: resultLogin.data.guid,
                                },
                                success: function() {
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ env('URL_API') }}/api/v1/send-otp",
                                        data: {
                                            guid: resultLogin.data.guid,
                                        },
                                        beforeSend: function() {},
                                        success: function(resultLogin) {
                                            window.location =
                                                "/auth/otp/verify";
                                        },
                                        error: function(xhr, status, error) {
                                            var jsonResponse = JSON.parse(
                                                xhr.responseText);
                                            $('#error-message-register')
                                                .text(jsonResponse[
                                                    'message']);
                                            $('#error-message-register')
                                                .removeClass("d-none");
                                        }
                                    });
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            var jsonResponse = JSON.parse(xhr.responseText);
                            $('#error-message-register').text(jsonResponse['message']);
                            $('#error-message-register').removeClass("d-none");
                        }
                    });
                });
            });
        </script>
    @endsection
