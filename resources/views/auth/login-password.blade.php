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

                            <div class="input-group mb-3">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                    name="password" required autocomplete="current-password">
                                <div class="input-group-append input-group-text">
                                    <span class="fa fa-lock"></span>
                                </div>
                            </div>
                            <label class="form-label fw-500 d-none" id="error-message-login"
                                style="color: #EE3C3B;"></label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" id="login"
                                        class="btn btn-primary btn-block">{{ __('Login') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    success: function(resultLogin) {
                        $.ajax({
                            type: "GET",
                            url: "{{ env('URL_API') }}/api/v1/user/self",
                            beforeSend: function(request) {
                                request.setRequestHeader("Authorization",
                                    "Bearer " + resultLogin.data.access_token);
                            },
                            success: function(result) {
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('session.login') }}",
                                    data: {
                                        _token: "{{ csrf_token() }}",
                                        access_token: resultLogin.data
                                            .access_token,
                                        name: result.data.name,
                                        guid: result.data.guid,
                                        country: result.data.country
                                    },
                                    success: function() {
                                        window.location = "/dashboard";
                                    }
                                });
                            },
                            error: function(xhr) {
                                var jsonResponse = JSON.parse(xhr.responseText);
                                $('#error-message-login').text(jsonResponse
                                    .message);
                                $('#error-message-login').removeClass("d-none");
                            }
                        });
                    },
                    error: function(xhr) {
                        var jsonResponse = JSON.parse(xhr.responseText);
                        $('#error-message-login').text(jsonResponse.message);
                        $('#error-message-login').removeClass("d-none");
                    }
                });
            });
        });
    </script>
@endsection
