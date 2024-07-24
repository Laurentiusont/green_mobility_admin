@extends('layouts.template')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Dashboard') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card ">
                        <div class="card-body mx-5 ">
                            <div class="row d-flex justify-content-center align-items-center" >
                                <div class="col-md-7">
                                    <h1 class="juduldash" style="font-size:2.5em">Terima kasih telah mengisi form</h1>
                                    <h5>Selanjutnya reward akan dikirimkan melalui email setelah melalui proses review.</h5>

                                </div>
                                <div class="col-md-5">
                                    <img src="{{ asset('images/survey.jpg') }}" style="height:auto;width:100%;padding:3rem" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection