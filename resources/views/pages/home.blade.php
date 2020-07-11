@extends("app")
@section("content")
<!-- ===== Page-Content ===== -->
        <div class="page-wrapper">
            <div class="row m-0">
                <div class="container-fluid">
                    <div class="col-md-12 col-sm-12">
                        <div class="jumbotron">
                            <h1 class="display-4">Halo!</h1>
                                <p class="lead">Selamat Datang.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ===== Page-Container ===== -->
            <div class="container-fluid">
                <!-- ===== Right-Sidebar ===== -->
                @include("_particles.rightbar")
                <!-- ===== Right-Sidebar-End ===== -->
            </div>
            <!-- ===== Page-Container-End ===== -->
            
        @include("_particles.footer")
        </div>
        <!-- ===== Page-Content-End ===== -->
@endsection