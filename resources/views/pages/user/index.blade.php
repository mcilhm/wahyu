@extends("app")
@section("content")
    <!-- Page Content -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- /row -->
            <div class="row">
                <div class="col-sm-8">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Data Export</h3>
                        <div class="col-lg-2 col-sm-4 col-xs-12 pull-right">
                        </div>
                        <p class="text-muted m-b-30">Export data to Copy, CSV, Excel, PDF & Print</p>
                        <div class="table-responsive">
                            <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>User Fullname</th>
                                        <th>User Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>User Fullname</th>
                                        <th>User Email</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Form</h3>
                        <p class="text-muted m-b-30 font-13"> Fill out the form correctly </p>
                        {{ Form::open(array('action' => array('UserController@store'), 'method' => 'POST' ,'class' => 'form-horizontal','enctype' => 'multipart/form-data')) }}
                            <input type="hidden" name="id" value="{{ isset($country->id) ? $country->id : null }}">
                            <div class="form-group">
                                <label class="control-label">Username</label>
                                <input type="text" required="" class="form-control" placeholder="Username" name="username" value="{{ isset($user->username) ? $user->username : null }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Fullname</label>
                                <input type="text" required="" class="form-control" placeholder="Fullname" name="user_fullname" value="{{ isset($user->user_fullname) ? $user->user_fullname : null }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <input type="email" required="" class="form-control" placeholder="Email" name="user_email" value="{{ isset($user->user_email) ? $user->user_email : null }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Password</label>
                                <input type="password" required="" class="form-control" placeholder="Password" name="password" value="{{ isset($user->password) ? $user->password : null }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info waves-effect waves-light m-t-10">Proses</button>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            <!-- /.row -->
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
@section('footer')
<script></script>
<script type="text/javascript">
    $( document ).ready(function() {

            $('#example23').DataTable({
                processing: true,
                serverSide: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                ajax : {
                    "url": "user/userlist"
                },
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: true, className: "text-center "},
                    {data: 'username', name: 'username', searchable: true},
                    {data: 'user_fullname', name: 'user_fullname', searchable: true},
                    {data: 'user_email', name: 'user_email', searchable: true},
                    {data: 'action', name: 'action', orderable: false}
                ]
            });

    });
</script>
@endsection