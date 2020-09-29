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
                                        <th>No Reg</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Division</th>
                                        <th>Department</th>
                                        <th>Section</th>
                                        <th>Class</th>
                                        <th>Position</th>
                                        <th>Job Status</th>
                                        <th>Date Of Entry</th>
                                        <th>Date Of Birthday</th>
                                        <th>Education</th>
                                        <th>Work Location</th>
                                        <th>Marital Status</th>
                                        <th>Genderr</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>No Reg</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Division</th>
                                        <th>Department</th>
                                        <th>Section</th>
                                        <th>Class</th>
                                        <th>Position</th>
                                        <th>Job Status</th>
                                        <th>Date Of Entry</th>
                                        <th>Date Of Birthday</th>
                                        <th>Education</th>
                                        <th>Work Location</th>
                                        <th>Marital Status</th>
                                        <th>Genderr</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Status</th>
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
                        {{ Form::open(array('action' => array('Admin\EmployeeController@store'), 'method' => 'POST' ,'class' => 'form-horizontal','enctype' => 'multipart/form-data')) }}
                            <input type="hidden" name="id" value="{{ isset($employee->id) ? $employee->id : null }}">
                            <div class="form-group">
                                <label class="control-label">No Reg</label>
                                <input type="text" required="" class="form-control" placeholder="No Reg" name="no_reg" value="{{ isset($employee->no_reg) ? $employee->no_reg : null }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">First Name</label>
                                <input type="text" required="" class="form-control" placeholder="First Name" name="first_name" value="{{ isset($employee->first_name) ? $employee->first_name : null }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Last Name</label>
                                <input type="text" required="" class="form-control" placeholder="Last Name" name="last_name" value="{{ isset($employee->last_name) ? $employee->last_name : null }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Division ID</label>
                                <select class="form-control" name="division_id" required>
                                    <option>- Select -</option>
                                    @foreach($division as $row)
                                    <option value="{{ $row->id }}" <?php if(isset($employee->division_id)) if($row->id == $employee->division_id){ echo "selected"; }?>>{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Department ID</label>
                                <select class="form-control" name="department_id" required disabled>
                                    <option value=''>- Select -</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Section ID</label>
                                <select class="form-control" name="section_id" required disabled>
                                    <option>- Select -</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Class ID</label>
                                <select class="form-control" name="kelas_id" required>
                                    <option>- Select -</option>
                                    @foreach($kelas as $row)
                                    <option value="{{ $row->id }}" <?php if(isset($employee->kelas_id))  if($row->id == $employee->kelas_id){ echo "selected"; }?>>{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Position ID</label>
                                <select class="form-control" name="position_id" required>
                                    <option>- Select -</option>
                                    @foreach($position as $row)
                                    <option value="{{ $row->id }}" <?php if(isset($employee->position_id)) if($row->id == $employee->position_id){ echo "selected"; }?>>{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Job Status</label>
                                <select class="form-control" name="job_status" required>
                                    <option>- Select -</option>
                                    <option value="0" <?php if(isset($employee->job_status)) if($employee->job_status == "0"){ echo "selected"; }?>>DL</option>
                                    <option value="1" <?php if(isset($employee->job_status)) if($employee->job_status == "1"){ echo "selected"; }?>>IDL</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Date Of Entry</label>
                                <input type="date" required="" class="form-control" placeholder="Date of entry" name="date_of_entry" value="{{ isset($employee->date_of_entry) ? $employee->date_of_entry : null }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Date Of Birthday</label>
                                <input type="date" required="" class="form-control" placeholder="Date of birthday" name="date_of_birthday" value="{{ isset($employee->date_of_birthday) ? $employee->date_of_birthday : null }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Education ID</label>
                                <select class="form-control" name="education_id" required>
                                    <option>- Select -</option>
                                    @foreach($education as $row)
                                    <option value="{{ $row->id }}" <?php if(isset($employee->education_id)) if($row->id == $employee->education_id){ echo "selected"; }?>>{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Work Location</label>
                                <input type="text" required="" class="form-control" placeholder="Work Location" name="work_location" value="{{ isset($employee->work_location) ? $employee->work_location : null }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Marital Status</label>
                                <select class="form-control" name="marital_status" required>
                                    <option>- Select -</option>
                                    <option value="0" <?php if(isset($employee->marital_status)) if($employee->marital_status == "0"){ echo "selected"; }?>>Sudah Menikah</option>
                                    <option value="1" <?php if(isset($employee->marital_status)) if($employee->marital_status == "1"){ echo "selected"; }?>>Belum Menikah</option>
                                </select>
                             </div>
                            <div class="form-group">
                                <label class="control-label">Gender</label>
                                <select class="form-control" name="gender" required>
                                    <option>- Select -</option>
                                    <option value="0" <?php if(isset($employee->gender)) if($employee->gender == "0"){ echo "selected"; }?>>Laki-laki</option>
                                    <option value="1" <?php if(isset($employee->gender)) if($employee->gender == "1"){ echo "selected"; }?>>Wanita</option>
                                </select>
                             </div>
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <input type="email" required="" class="form-control" placeholder="Email" name="email" value="{{ isset($employee->email) ? $employee->email : null }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Phone Number</label>
                                <input type="text" required="" class="form-control" placeholder="Phone Number" name="phone_number" value="{{ isset($employee->phone_number) ? $employee->phone_number : null }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Status</label>
                                <select class="form-control" name="status" required>
                                    <option>- Select -</option>
                                    <option value="0" <?php if(isset($employee->status)) if($employee->status == "0"){ echo "selected"; }?>>PKWT</option>
                                    <option value="1" <?php if(isset($employee->status)) if($employee->status == "1"){ echo "selected"; }?>>PKWTT</option>
                                </select>
                             </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info waves-effect waves-light m-t-10">Proses</button>
                                <a href="{{ url('employee') }}" class="btn btn-danger waves-effect waves-light m-t-10">Cancel</a>
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

    $(function() {
        $('select[name="division_id"]').change(function () {
            var url = "{{ url('division') }}/" + $(this).val() + "/department";

            $.get(url, function (data) {
                $('select[name="department_id"]').prop("disabled", false);
                var select = $('form select[name="department_id"]');
                select.empty();
                select.append("<option value=''>- PILIH -</option>");
                $.each(data,function (key,value) {
                    select.append("<option value='" + value.id + "'>" + value.name + "</option>");
                });
            });
        });


        $('select[name="department_id"]').change(function () {
            var url = "{{ url('department') }}/" + $(this).val() + "/section";

            $.get(url, function (data) {
                $('select[name="section_id"]').prop("disabled", false);
                var select = $('form select[name="section_id"]');
                select.empty();
                select.append("<option value=''>- PILIH -</option>");
                $.each(data,function (key,value) {
                    select.append("<option value='" + value.id + "'>" + value.name + "</option>");
                });
            });
        });
    });
    $(document).ready(function() {

        $('#example23').DataTable({
            processing: true,
            serverSide: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            ajax : {
                "url": "employee/employeelist"
            },
            columns: [
                {data: 'id', name: 'id', orderable: false, searchable: true, className: "text-center "},
                {data: 'no_reg', name: 'no_reg', searchable: true},
                {data: 'first_name', name: 'first_name', searchable: true},
                {data: 'last_name', name: 'last_name', searchable: true},
                {data: 'division_name', name: 'division_name', searchable: true},
                {data: 'department_name', name: 'department_name', searchable: true},
                {data: 'section_name', name: 'section_name', searchable: true},
                {data: 'kelas_name', name: 'kelas_name', searchable: true},
                {data: 'position_name', name: 'position_name', searchable: true},
                {data: 'job_status', name: 'job_status', searchable: true},
                {data: 'date_of_entry', name: 'date_of_entry', searchable: true},
                {data: 'date_of_birthday', name: 'date_of_birthday', searchable: true},
                {data: 'education_name', name: 'education_name', searchable: true},
                {data: 'work_location', name: 'work_location', searchable: true},
                {data: 'marital_status', name: 'marital_status', searchable: false},
                {data: 'gender', name: 'gender', searchable: false},
                {data: 'email', name: 'email', searchable: false},
                {data: 'phone_number', name: 'phone_number', searchable: false},
                {data: 'status', name: 'status', searchable: true},
                {data: 'action', name: 'action', orderable: false}
            ]
        });

    });
</script>
@endsection
