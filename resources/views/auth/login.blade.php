@extends('auth.master')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <img src="{{ asset('images/logo.png') }}" style="width:100%;height:auto">
            </div>
            <div class="col-md-6">
                <div class="card" style="border-radius: 20px">
                    <div class="card-body">
                        <h3 class="login-box-msg">{{ __('Login') }}</h3>
                        <form method="POST" action="javascript:void(0)" id="loginForm">
                            @csrf
                            <div class="input-group mb-3">
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                </div>

                            </div>
                            <label class="form-label fw-500 d-none" id="error-message-login"
                                style="color: #EE3C3B;"></label>

                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <p class="mb-0">
                            @if (Route::has('register'))
                                Not registered yet? <a href="{{ route('register') }}">{{ __('Register here') }}</a>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('library')
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ env('URL_API') }}/api/v1/auth/login",
                    data: formData,
                    success: function(response) {
                        if (response.data === true) {
                            window.location = "{{ route('google-auth') }}";
                        } else {
                            window.location = "/login-password";
                        }
                    },
                    error: function(xhr, status, error) {
                        var jsonResponse = JSON.parse(xhr.responseText);
                        $('#error-message-login').text(jsonResponse['message']);
                        $('#error-message-login').removeClass("d-none");
                    }
                });
            });
        });
    </script>
@endsection
