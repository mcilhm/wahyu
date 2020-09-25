
@extends("app")
@section("content")
    <!-- Page Content -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- /row -->
            <div class="row">
                <div class="col-sm-12">
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
                                        <th>Date of Submission</th>
                                        <th>Reason of Submission</th>
                                        <th>Type Submission</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>ID Employee</th>
                                        <th>Full Name</th>
                                        <th>Date of Submission</th>
                                        <th>Reason of Submission</th>
                                        <th>Type Submission</th>
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
                    "url": "/submissionemployee/" + {{ $status_of_submission }} + "/submissionlist"
                },
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: true, className: "text-center "},
                    {data: 'id_employee', name: 'activity_name', searchable: true},
                    {data: 'full_name', name: 'full_name', searchable: true},
                    {data: 'date_of_submission', name: 'date_of_submission', searchable: true},
                    {data: 'reason_of_submission', name: 'reason_of_submission', searchable: true},
                    {data: 'type_submission', name: 'type_submission', searchable: true},
                    {data: 'action', name: 'action', orderable: false},
                    {data: 'decline', name: 'decline', orderable: false}
                ]
            });

    });
</script>
@endsection
