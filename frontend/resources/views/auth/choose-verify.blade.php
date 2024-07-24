@extends('layouts.guest')

@section('content')
<div class="container">

    <div class="card-body login-card-body bg-transparent">
        <div class="row mt-3 d-flex justify-content-center align-items-center" style="min-height: 60vh">
            <div class="col-12">
                <h1 class="text-center">Silahkan Verifikasi Data Diri Anda</h1>
            </div>
            <div class="col-6">
                <a href="{{ route('google-verify') }}" class="btn btn-lg btn-danger btn-block">{{ __('Verify with Google') }}</a>
            </div>
            <div class="col-6">
                <a id="otp" class="btn btn-lg btn-success btn-block">{{ __('Verify with OTP') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('library')
    <script type="text/javascript">
        $(document).ready(function() {

            $("#otp").click(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ env('URL_API') }}/api/v1/send-otp",
                    data: {
                        guid: "{{ $guid }}",
                    },
                    beforeSend: function() {},
                    success: function(resultLogin) {
                        window.location =
                            "/auth/otp/verify";

                    },
                    error: function(xhr, status, error) {
                        // console(error);
                    }
                });

            });
        });
    </script>
@endsection
