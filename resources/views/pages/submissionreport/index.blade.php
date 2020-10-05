@extends("app")
@section("content")
    <!-- Page Content -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- /row -->
            <div class="row">
                <ul class="nav nav-tabs nav-pills">
                    <li class="active"><a data-toggle="tab" href="#resign">Resign</a></li>
                    <li><a data-toggle="tab" href="#pensiun">Pensiun</a></li>
                    <li><a data-toggle="tab" href="#endedcontract">Ended Contract</a></li>
                </ul>

                <div class="tab-content">
                    
                    <div id="resign" class="tab-pane fade in active">
                        <div class="col-sm-12">
                            <div class="white-box">
                                <h3 class="box-title m-b-0">Data Export</h3>
                                <div class="col-lg-2 col-sm-4 col-xs-12 pull-right">
                                </div>
                                <p class="text-muted m-b-30">Export data to Copy, CSV, Excel, PDF & Print</p>
                                <div class="table-responsive">
                                    <table id="example22" class="display nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>No Reg</th>
                                                <th>Full Name</th>
                                                <th>Status of Submission</th>
                                                <th>Status of Document</th>
                                                <th>Status of Exit Interview</th>
                                                <th>Status of Administration</th>
                                                <th>Generated Document</th>
                                                <th>Generated Result Interview</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>No Reg</th>
                                                <th>Full Name</th>
                                                <th>Status of Submission</th>
                                                <th>Status of Document</th>
                                                <th>Status of Exit Interview</th>
                                                <th>Status of Administration</th>
                                                <th>Generated Document</th>
                                                <th>Generated Result Interview</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="pensiun" class="tab-pane fade">
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
                                                <th>Full Name</th>
                                                <th>Status of Submission</th>
                                                <th>Status of Document</th>
                                                <th>Status of Administration</th>
                                                <th>Generated Document</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>No Reg</th>
                                                <th>Full Name</th>
                                                <th>Status of Submission</th>
                                                <th>Status of Document</th>
                                                <th>Status of Administration</th>
                                                <th>Generated Document</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="endedcontract" class="tab-pane fade">
                        <div class="col-sm-12">
                            <div class="white-box">
                                <h3 class="box-title m-b-0">Data Export</h3>
                                <div class="col-lg-2 col-sm-4 col-xs-12 pull-right">
                                </div>
                                <p class="text-muted m-b-30">Export data to Copy, CSV, Excel, PDF & Print</p>
                                <div class="table-responsive">
                                    <table id="example24" class="display nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>No Reg</th>
                                                <th>Full Name</th>
                                                <th>Status of Document</th>
                                                <th>Status of Administration</th>
                                                <th>Generated Document</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>No Reg</th>
                                                <th>Full Name</th>
                                                <th>Status of Document</th>
                                                <th>Status of Administration</th>
                                                <th>Generated Document</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
                "url": "submissionreport/resignlist"
            },
            columns: [
                {data: 'id', name: 'id', orderable: false, searchable: true, className: "text-center "},
                {data: 'no_reg', name: 'no_reg', searchable: true},
                {data: 'fullname', name: 'fullname', searchable: true},
                {data: 'submission', name: 'submission', searchable: true, className: "text-center "},
                {data: 'document', name: 'document', searchable: true, className: "text-center "},
                {data: 'exit_interview', name: 'exit_interview', searchable: true, className: "text-center "},
                {data: 'administration', name: 'administration', searchable: true, className: "text-center "},
                {data: 'result_all_file', name: 'result_all_file', searchable: true, className: "text-center "},
                {data: 'result_exit_interview_file', name: 'result_exit_interview_file', searchable: true, className: "text-center "},
            ]
        });

        $('#example23').DataTable({
            processing: true,
            serverSide: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            ajax : {
                "url": "submissionreport/pensiunlist"
            },
            columns: [
                {data: 'id', name: 'id', orderable: false, searchable: true, className: "text-center "},
                {data: 'no_reg', name: 'no_reg', searchable: true},
                {data: 'fullname', name: 'fullname', searchable: true},
                {data: 'submission', name: 'submission', searchable: true, className: "text-center "},
                {data: 'document', name: 'document', searchable: true, className: "text-center "},
                {data: 'administration', name: 'administration', searchable: true, className: "text-center "},
                {data: 'result_all_file', name: 'result_all_file', searchable: true, className: "text-center "},
            ]
        });

        $('#example24').DataTable({
            processing: true,
            serverSide: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            ajax : {
                "url": "submissionreport/endedcontractlist"
            },
            columns: [
                {data: 'id', name: 'id', orderable: false, searchable: true, className: "text-center "},
                {data: 'no_reg', name: 'no_reg', searchable: true},
                {data: 'fullname', name: 'fullname', searchable: true},
                {data: 'document', name: 'document', searchable: true, className: "text-center "},
                {data: 'administration', name: 'administration', searchable: true, className: "text-center "},
                {data: 'result_all_file', name: 'result_all_file', searchable: true, className: "text-center "},
            ]
        });

    });
</script>
@endsection
