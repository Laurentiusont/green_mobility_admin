@extends('auth.master')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <img src="{{ asset('images/logo.png') }}" style="width:100%;height:auto">
            </div>
            <div class="col-md-6">
                <div class="card" style="border-radius: 20px">
                    <div class="card-body ">
                        <h3 class="login-box-msg">{{ __('Login') }}</h3>

                        <div>
                            <div class="input-group mb-3">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>
                                <div class="input-group-append input-group-text">
                                    <span class="fa fa-envelope"></span>
                                </div>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            {{-- <div class="input-group mb-3">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Password" name="password" required autocomplete="current-password">
                                <div class="input-group-append input-group-text">
                                    <span class="fa fa-lock"></span>
                                </div>
                            </div> --}}
                            {{-- <label class="form-label fw-500 d-none" id="error-message-login"
                                style="color: #EE3C3B;"></label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror --}}

                            <div class="row">
                                <div class="col-8">
                                    {{-- <div class="icheck-primary">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                    {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div> --}}
                                </div>
                                <!-- /.col -->
                                <div class="col-12">
                                    <button type="submit" id="login"
                                        class="btn btn-primary btn-block ">{{ __('Login') }}</button>
                                </div>
                                {{-- <div class="col-12">

                                    <!-- Google login button -->
                                    <div class="text-center mt-3">
                                        <a href="{{ route('google-auth') }}" class="btn btn-danger btn-block"><i
                                                class="fab fa-google mr-2"></i>Login with Google</a>
                                    </div>
                                    <!-- /.social-auth-links -->
                        
                                </div> --}}
                                <!-- /.col -->
                            </div>

                        </div>

                        <hr>
                        <p class="mb-0">
                            @if (Route::has('register'))
                                Not registered yet? <a href="{{ route('register') }}">{{ __('Register here') }}</a>
                            @endif
                        </p>

                    </div>
                    <!-- /.login-card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection


@section('library')
    <script type="text/javascript">
        $(document).ready(function() {

            $("#login").click(function(e) {
                e.preventDefault();

                var emailAddress = $("#email").val();
                var loginPassword = $("#password").val();

                $.ajax({
                    type: "POST",
                    url: "{{ env('URL_API') }}/api/v1/auth/login",
                    data: {
                        email: emailAddress,
                        password: loginPassword,
                    },
                    beforeSend: function() {
                        // $('#loading-sign-in').removeClass("d-none");
                        // $('#btn-sign-in').addClass("d-none");
                    },
                    success: function(resultLogin) {
                        // $('#loading-sign-in').addClass("d-none");
                        // $('#btn-sign-in').removeClass("d-none");

                        $.ajax({
                            type: "GET",
                            url: "{{ env('URL_API') }}/api/v1/user/self",
                            data: {
                                _token: "{{ csrf_token() }}",
                            },
                            beforeSend: function(request) {
                                // $('#loading-sign-in').removeClass("d-none");
                                // $('#btn-sign-in').addClass("d-none");

                                request.setRequestHeader("Authorization",
                                    "Bearer " + resultLogin['data'][
                                        'access_token'
                                    ],
                                );
                            },
                            success: function(result) {
                                // $('#loading-sign-in').addClass("d-none");
                                // $('#btn-sign-in').removeClass("d-none");

                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('session.login') }}",
                                    data: {
                                        _token: "{{ csrf_token() }}",
                                        access_token: resultLogin['data'][
                                            'access_token'
                                        ],
                                        name: result['data'][
                                            'name'
                                        ],
                                        guid: result['data'][
                                            'guid'
                                        ],
                                        country: result['data']['country']
                                    },
                                    success: function(result) {

                                        window.location =
                                            "/dashboard";

                                    }
                                });

                            },
                            error: function(xhr, status, error) {
                                // $('#loading-sign-in').addClass("d-none");
                                // $('#btn-sign-in').removeClass("d-none");

                                var jsonResponse = JSON.parse(xhr.responseText);
                                $('#error-message-login').text(jsonResponse[
                                    'message']);
                                $('#error-message-login').removeClass("d-none");
                            }
                        });

                    },
                    error: function(xhr, status, error) {
                        // $('#loading-sign-in').addClass("d-none");
                        // $('#btn-sign-in').removeClass("d-none");

                        var jsonResponse = JSON.parse(xhr.responseText);
                        $('#error-message-login').text(jsonResponse['message']);
                        $('#error-message-login').removeClass("d-none");
                    }
                });

            });
        });
    </script>
@endsection
