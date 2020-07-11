@extends("app")
@section("content")
<!-- Page Content -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- .row -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Sample Horizontal form with icon</h3>
                        <p class="text-muted m-b-30 font-13"> Use Bootstrap's predefined grid classes for horizontal form </p>
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="exampleInputuname" class="col-sm-3 control-label">Username*</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-user"></i></div>
                                        <input type="text" class="form-control" id="exampleInputuname" placeholder="Username"> </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="col-sm-3 control-label">Email*</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-email"></i></div>
                                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"> </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Website</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-world"></i></div>
                                        <input type="text" class="form-control" id="exampleInputpwd1" placeholder="Enter Website Name"> </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label">Password*</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-lock"></i></div>
                                        <input type="password" class="form-control" id="exampleInputpwd2" placeholder="Enter pwd"> </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword4" class="col-sm-3 control-label">Re Password*</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-lock"></i></div>
                                        <input type="password" class="form-control" id="exampleInputpwd2" placeholder="Re Enter pwd"> </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox33" type="checkbox">
                                        <label for="checkbox33">Check me out !</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-b-0">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-info waves-effect waves-light m-t-10">Sign in</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ===== Right-Sidebar ===== -->
            @include("_particles.rightbar")
            <!-- ===== Right-Sidebar-End ===== -->
        </div>
        <!-- /.container-fluid -->
        @include("_particles.footer")
    </div>
    <!-- /#page-wrapper -->
        <!-- ===== Page-Content-End ===== -->
@endsection