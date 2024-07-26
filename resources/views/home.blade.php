@extends('layouts.template')

@section('content')

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid px-3 mt-2">
            <div class="jumbotron text-center">
                <h1 class="display-4">SSTRANGE</h1>
                <h2 class="display-6"><b>S</b>calable <b>S</b>imilarity <b>TR</b>acker in <b>A</b>cademia with <b>N</b>atural lan<b>G</b>uage <b>E</b>xplanation</h2>
                <p class="lead">Efficiently track similarities among submissions in various programming languages with SSTRANGE.</p>
            </div>
    
            <section id="details">
                <h2>General Details</h2>
                <p>SSTRANGE is a scalable and efficient tool to observe similarities among submissions with locality sensitive hashing: MinHash and Super-Bit. Currently, the tool supports Java, Python, C#, Dart, and Web (HTML+JS+CSS+PHP) submissions. It also incorporates sensitive similarity.</p>
            </section>
    
            <hr>
    
            <section id="publications">
                <h2>Publications</h2>
                <ul>
                    <li>Details of SSTRANGE can be found in the paper published in MDPI's Education Sciences as part of the special issue "Application of New Technologies for Assessment in Higher Education".</li>
                    <li>Details of C# mode can be seen in the paper published in the 2023 IEEE International Conference on Advanced Learning Technologies (ICALT), which was awarded the best discussion paper at the conference.</li>
                    <li>Details of sensitive similarity can be seen in the paper published in the 2024 IEEE World Engineering Education Conference (EDUNINE).</li>
                </ul>
            </section>
    
            <hr>
    
            <section id="instructions">
                <h2>Usage Instructions</h2>
                <p>Unlike its counterpart, Comprehensive STRANGE, SSTRANGE focuses on efficiency and is suitable for large submissions. For comprehensive reporting, it is recommended to use Comprehensive STRANGE or CSTRANGE instead.</p>
                <p>SSTRANGE and CSTRANGE have comparable features: graphical user interface, template code removal, and common code removal.</p>
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{ route('form') }}" class="btn btn-primary w-100 mb-3">Start SStrange</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- /.content -->
@endsection