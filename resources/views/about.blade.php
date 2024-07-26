@extends('layouts.template')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('About us') }}</h1>
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
                    <div class="card">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-md-4">
                                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-100">
                                </div>
                                <div class="col-md-8">
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <h3>Our Story</h3>
                                            <p>SSTRANGE (Scalable Similarity TRacker in Academia with Natural lanGuage Explanation) is dedicated to enhancing assessment processes in higher education through innovative technology. Our tool leverages advanced techniques like MinHash and Super-Bit to observe similarities among academic submissions efficiently and at scale.</p>
                                        </div>
                                    </div>
                    
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <h3>Our Team</h3>
                                            <p>Our team comprises experts in computer science, machine learning, and educational assessment. We are committed to continuously improving SSTRANGE to meet the evolving needs of educators and students worldwide.</p>
                                        </div>
                                    </div>
                    
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <h3>Our Goals</h3>
                                            <ul>
                                                <li>Enhance the efficiency and scalability of assessment processes.</li>
                                                <li>Provide robust tools that support multiple programming languages and sensitive similarity detection.</li>
                                                <li>Empower educators with reliable insights into academic integrity and content originality.</li>
                                            </ul>
                                        </div>
                                    </div>
                    
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <h3>Our Values</h3>
                                            <ul>
                                                <li><strong>Innovation:</strong> We embrace innovation to drive meaningful change in educational assessment.</li>
                                                <li><strong>Integrity:</strong> We uphold the highest standards of academic integrity and ethical conduct.</li>
                                                <li><strong>Collaboration:</strong> We foster collaboration among educators, researchers, and technologists to create impactful solutions.</li>
                                                <li><strong>Excellence:</strong> We are committed to excellence in everything we do, ensuring our tools exceed expectations.</li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                   <p class="fs-6"> <a href="https://github.com/oscarkarnalim/SSTRANGE" target="_blank" >Visit our GitHub repository</a> to learn more about our projects </p>
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