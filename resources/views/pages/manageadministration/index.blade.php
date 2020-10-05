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
                            <table id="example22" class="display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>No Reg</th>
                                        <th>Full Name</th>
                                        <th>Type Submission</th>
                                        <th>Status of Document</th>
                                        <th>Status of Administration</th>
                                        <th>Status of Submission</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>No Reg</th>
                                        <th>Full Name</th>
                                        <th>Type Submission</th>
                                        <th>Status of Document</th>
                                        <th>Status of Administration</th>
                                        <th>Status of Submission</th>
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
        
        $('#example22').DataTable({
            processing: true,
            serverSide: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            ajax : {
                "url": "manageadministration/manageadministrationlist"
            },
            columns: [
                {data: 'id', name: 'id', orderable: false, searchable: true, className: "text-center "},
                {data: 'no_reg', name: 'no_reg', searchable: true},
                {data: 'full_name', name: 'full_name', searchable: true},
                {data: 'type_submission', name: 'type_submission', searchable: true},
                {data: 'document', name: 'document', searchable: true, className: "text-center "},
                {data: 'administration', name: 'administration', searchable: true, className: "text-center "},
                {data: 'submission', name: 'submission', searchable: true, className: "text-center "},
                {data: 'generate_document', name: 'generate_document', searchable: true, className: "text-center "}
            ]
        });
    });
</script>
@endsection
