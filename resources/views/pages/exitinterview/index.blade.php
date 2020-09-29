
@extends("app")
@section("content")
    <!-- Page Content -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- /row -->
            <div class="row">
                @if ($interview != null)
                    <div class="col-sm-8">
                @else
                    <div class="col-sm-12">
                @endif
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Data Export</h3>
                        <p class="text-muted m-b-30">Export data to Copy, CSV, Excel, PDF & Print</p>
                        <div class="table-responsive">
                            <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ID Employee</th>
                                        <th>Full Name</th>
                                        <th>Date of Interview</th>
                                        <th>Reason of Submission</th>
                                        <th>Type Submission</th>
                                        <th>Status</th>
                                        <th>Exit Interview</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>ID Employee</th>
                                        <th>Full Name</th>
                                        <th>Date of Interview</th>
                                        <th>Reason of Submission</th>
                                        <th>Type Submission</th>
                                        <th>Status</th>
                                        <th>Exit Interview</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @if ($interview != null)
                <div class="col-sm-4">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Form</h3>
                        <p class="text-muted m-b-30 font-13"> Fill out the form correctly </p>
                        {{ Form::open(array('action' => array('Admin\ExitInterviewController@store'), 'method' => 'POST' ,'class' => 'form-horizontal','enctype' => 'multipart/form-data')) }}
                            <input type="hidden" name="id" value="{{ isset($interview->id) ? $interview->id : null }}">
                            <div class="form-group">
                                <label class="control-label">ID Resign</label>
                                <input type="text" class="form-control" placeholder="ID Resign" name="id_resign" required value="{{ isset($interview->id) ? $interview->id : null }}" disabled>
                            </div>
                            <div class="form-group">
                                <label class="control-label">No Reg Employee</label>
                                <input type="text" class="form-control" placeholder="No Reg Employee" name="no_reg" required value="{{ isset($interview->no_reg) ? $interview->no_reg : null }}" disabled>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Date of Submission</label>
                                <input type="text" class="form-control" placeholder="Date of Submission" name="date_of_submission" value="{{ isset($interview->date_of_submission) ? $interview->date_of_submission : null }}" disabled>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Reason of resign</label>
                                <select class="form-control" name="reason_of_resign" required>
                                    <option>- Select -</option>
                                    <option value="Continuation Education">Continuation Education</option>
                                    <option value="Family Focus">Family Focus</option>
                                    <option value="Move to other company">Move to other company</option>
                                    <option value="Run Private Enterprise">Run Private Enterprise</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Result of Exit Interview</label>
                                <input type="file" class="form-control" name="result_exit_interview_file" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info waves-effect waves-light m-t-10">Save</button>
                                <a href="{{ url('exitinterview/') }}" class="btn btn-danger waves-effect waves-light m-t-10">Cancel</a>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
                @endif

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
                    "url": "exitinterview/exitinterviewlist"
                },
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: true, className: "text-center "},
                    {data: 'id_employee', name: 'activity_name', searchable: true},
                    {data: 'full_name', name: 'full_name', searchable: true},
                    {data: 'date_of_interview', name: 'date_of_submission', searchable: true},
                    {data: 'reason_of_submission', name: 'reason_of_submission', searchable: true},
                    {data: 'type_submission', name: 'type_submission', searchable: true},
                    {data: 'status', name: 'status', searchable: true},
                    {data: 'exit_interview', name: 'exit_interview', searchable: true},
                ]
            });

    });
</script>
@endsection
