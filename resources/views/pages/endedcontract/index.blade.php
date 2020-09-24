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
                                        <th>Date Of Entry</th>
                                        <th>Email</th>
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
                                        <th>Date Of Entry</th>
                                        <th>Email</th>
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
    $(document).ready(function() {

        $('#example23').DataTable({
            processing: true,
            serverSide: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            ajax : {
                "url": "endedcontract/endedcontractlist"
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
                {data: 'date_of_entry', name: 'date_of_entry', searchable: true},
                {data: 'email', name: 'email', searchable: false},
                {data: 'action', name: 'action', orderable: false}
            ]
        });

    });
</script>
@endsection
