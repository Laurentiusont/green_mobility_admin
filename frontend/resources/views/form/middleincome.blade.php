@extends('layouts.template')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Form Kuestioner Negara Pendapatan Menengah') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">

                        <div class="col-md-5">
                            <h4>Petunjuk pengisian</h4>
                            <ol >
                                <li><p>Mohon Kuestioner diisi dengan baik dan benar.</p></li>
                                <li><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam nihil ea officiis quas eum natus enim quod voluptate fuga doloremque adipisci libero, officia totam tempore molestiae optio voluptatibus, at voluptatum.</p></li>
                                <li><p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi cumque suscipit quod quo iste, quidem veniam ad porro autem sed totam, dolores nihil necessitatibus magni vitae nemo itaque, quaerat quas.</p></li>
                                <li><p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi cumque suscipit quod quo iste, quidem veniam ad porro autem sed totam, dolores nihil necessitatibus magni vitae nemo itaque, quaerat quas.</p></li>
                            </ol>
                            <div class="row d-flex justify-content-center align-items-center mt-5">
                                <div class="col-md-12">
                                    <h5>Jika sudah selesai, harap konfirmasi reward dengan klik</h5>
                                    <a href="{{ url('/selesai') }}" class="btn btn-primary w-100">Sudah Selesai</a>
                                </div>
                            </div>
                        </div>
                        <style>
                        .responsive-iframe-container {
                            position: relative;
                            padding-bottom: 45%; /* Adjust based on your form's height */
                            height: 0;
                            overflow: hidden;
                        }

                        .responsive-iframe-container iframe {
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                        }
                        </style>
                        <div class="col-md-7 responsive-iframe-container">
                            <iframe  src="https://docs.google.com/forms/d/e/1FAIpQLSd139jEZ76_B1NCFrCtMa6xY7cTeFq6bVnQYaxLpxPQkTxuHw/viewform?embedded=true"  frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection