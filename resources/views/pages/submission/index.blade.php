@php
// DB::enableQueryLog(); // Enable query log
$submissions = \App\Submission::where('id_employee', '=', Auth::user()->employee_id)->whereNotIn('status_of_submission', [-1, 4])->count();
$employee = App\Employee::where('no_reg', Auth::user()->username)->first();
$date_age = Carbon\Carbon::parse($employee->date_of_birthday)->addYears(55);
$age = Carbon\Carbon::parse($employee->date_of_birthday)->age;
// dd(DB::getQueryLog()); // Show results of log
@endphp

@extends("app")
@section("content")
    <!-- Page Content -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- /row -->
            <div class="row">
                @if ($submissions == 0)
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
                                        <th>Date of Ended Work</th>
                                        <th>Date of Submission</th>
                                        <th>Reason of Submission</th>
                                        <th>Type Submission</th>
                                        <th>Date of Interview</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>ID Employee</th>
                                        <th>Full Name</th>
                                        <th>Date of Ended Work</th>
                                        <th>Date of Submission</th>
                                        <th>Reason of Submission</th>
                                        <th>Type Submission</th>
                                        <th>Date of Interview</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @if ($submissions == 0)
                <div class="col-sm-4">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Form</h3>
                        <p class="text-muted m-b-30 font-13"> Fill out the form correctly </p>
                        {{ Form::open(array('action' => array('Admin\SubmissionController@store', $id_activity), 'method' => 'POST' ,'class' => 'form-horizontal','enctype' => 'multipart/form-data')) }}
                            <div class="form-group">
                                <label class="control-label">Date of Ended Work</label>
                                @if(($age*365) > 20075)
                                    <input type="date" class="form-control" placeholder="Description" name="date_of_ended_work" value="{{ $date_age->format('Y-m-d') }}" disabled>
                                @else
                                    <input type="date" class="form-control" placeholder="Description" name="date_of_ended_work" min="{{ (new DateTime())->format('Y-m-d') }}" value="{{ (new DateTime())->format('Y-m-d') }}">
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label">Reason of Submission</label>
                                <input type="text" required="" class="form-control" placeholder="Description" name="reason_of_submission">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Lampirkan File</label>
                                <input type="file" class="form-control" name="file_lampiran"  accept=".docx,.doc,.pdf" aria-label="Choose File" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info waves-effect waves-light m-t-10">Proses</button>
                                <a href="{{ url('submission/'.$id_activity) }}" class="btn btn-danger waves-effect waves-light m-t-10">Cancel</a>
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
                    "url": "/submission/" + {{ $id_activity }} + "/submissionlist"
                },
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: true, className: "text-center "},
                    {data: 'id_employee', name: 'activity_name', searchable: true},
                    {data: 'full_name', name: 'full_name', searchable: true},
                    {data: 'date_of_ended_work', name: 'date_of_ended_work', searchable: true},
                    {data: 'date_of_submission', name: 'date_of_submission', searchable: true},
                    {data: 'reason_of_submission', name: 'reason_of_submission', searchable: true},
                    {data: 'type_submission', name: 'type_submission', searchable: true},
                    {data: 'date_of_interview', name: 'date_of_interview', searchable: true},
                    {data: 'action', name: 'action', orderable: false}
                ]
            });

    });
</script>
@endsection
