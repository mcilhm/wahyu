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
                                        <th>No Reg (Employee)</th>
                                        <th>Role Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>No Reg (Employee)</th>
                                        <th>Role Name</th>
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
                        {{ Form::open(array('action' => array('Admin\UserController@store'), 'method' => 'POST' ,'class' => 'form-horizontal','enctype' => 'multipart/form-data')) }}
                            <input type="hidden" name="id" value="{{ isset($user->id) ? $user->id : null }}">
                            <div class="form-group">
                                <label class="control-label">Employee No REG</label>
                                <select class="form-control" name="username" required {{ isset($user->id) ? 'disabled' : '' }}>
                                    <option>- Select -</option>
                                    @foreach($employee as $row)
                                    <option value="{{ $row->no_reg }}" <?php if(isset($user->username)) if($row->no_reg == $user->username){ echo "selected"; }?>>{{ $row->no_reg. ' ( '.$row->first_name.' '.$row->last_name.' )' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Password <small>{{ isset($user->id) ? '(leave blank if you dont want to change it)' : '' }}</small></label>
                                <input type="password" class="form-control" placeholder="Password" name="password" {{ isset($user->id) ? '' : 'required' }}>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Role ID</label>
                                <select class="form-control" name="role_id" required>
                                    <option>- Select -</option>
                                    @foreach($role as $row)
                                    <option value="{{ $row->id }}" <?php if(isset($user->role_id)) if($row->id == $user->role_id){ echo "selected"; }?>>{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info waves-effect waves-light m-t-10">Proses</button>
                                <a href="{{ url('user') }}" class="btn btn-danger waves-effect waves-light m-t-10">Cancel</a>
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
                    {data: 'role_name', name: 'role_name', searchable: true},
                    {data: 'action', name: 'action', orderable: false}
                ]
            });

    });
</script>
@endsection
