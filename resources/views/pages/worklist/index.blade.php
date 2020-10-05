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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label"> Select Division</label>
                                            <select class="form-control selectpicker"name="id_division" id="id_division">
                                                <option value=0>- Select -</option>
                                                @foreach($division as $row)
                                                    @if($row->count_ended > 0)
                                                        <option value="{{ $row->id }}" data-content="<span class='badge badge-danger'>{{ $row->name }}</span>">{{ $row->name }} 
                                                    @else
                                                        <option value="{{ $row->id }}">{{ $row->name }} 
                                                    @endif
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
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
                                                <th>Division</th>
                                                <th>Department</th>
                                                <th>Section</th>
                                                <th>Class</th>
                                                <th>Status Generate</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>No Reg</th>
                                                <th>Full Name</th>
                                                <th>Division</th>
                                                <th>Department</th>
                                                <th>Section</th>
                                                <th>Class</th>
                                                <th>Status Generate</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a href="#" id="btn_generated_ended_contract" class="btn btn-xl btn-primary" style="display:none;"> Generate Ended Contract </a>
                                    </div>
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
                "url": "worklist/resignlist"
            },
            columns: [
                {data: 'id', name: 'id', orderable: false, searchable: true, className: "text-center "},
                {data: 'no_reg', name: 'no_reg', searchable: true},
                {data: 'fullname', name: 'fullname', searchable: true},
                {data: 'submission', name: 'submission', searchable: true, className: "text-center "},
                {data: 'document', name: 'document', searchable: true, className: "text-center "},
                {data: 'exit_interview', name: 'exit_interview', searchable: true, className: "text-center "},
                {data: 'administration', name: 'administration', searchable: true, className: "text-center "}
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
                "url": "worklist/pensiunlist"
            },
            columns: [
                {data: 'id', name: 'id', orderable: false, searchable: true, className: "text-center "},
                {data: 'no_reg', name: 'no_reg', searchable: true},
                {data: 'fullname', name: 'fullname', searchable: true},
                {data: 'submission', name: 'submission', searchable: true, className: "text-center "},
                {data: 'document', name: 'document', searchable: true, className: "text-center "},
                {data: 'administration', name: 'administration', searchable: true, className: "text-center "}
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
                "url": "worklist/" + 0 + "/endedcontractlist"
            },
            columns: [
                {data: 'id', name: 'id', orderable: false, searchable: true, className: "text-center "},
                {data: 'no_reg', name: 'no_reg', searchable: true},
                {data: 'fullname', name: 'fullname', searchable: true},
                {data: 'division_name', name: 'division_name', searchable: true},
                {data: 'department_name', name: 'department_name', searchable: true},
                {data: 'section_name', name: 'section_name', searchable: true},
                {data: 'kelas_name', name: 'kelas_name', searchable: true},
                {data: 'status_generated_ended_contract', name: 'status_generated_ended_contract', searchable: true}
            ]
        });
        var id_division;
        var select_division = document.getElementById("id_division");
        select_division.addEventListener("change", function() {
            id_division = select_division.value;
            var x = document.getElementById("btn_generated_ended_contract");

            if(id_division == 0) {
                x.style.display = "none";
            }
            else {
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }

            var table = $('#example24').DataTable();

            table.destroy();

            $('#example24').DataTable({
                processing: true,
                serverSide: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                ajax : {
                    "url": "worklist/" + id_division + "/endedcontractlist"
                },
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: true, className: "text-center "},
                    {data: 'no_reg', name: 'no_reg', searchable: true},
                    {data: 'first_name', name: 'first_name', searchable: true},
                    {data: 'division_name', name: 'division_name', searchable: true},
                    {data: 'department_name', name: 'department_name', searchable: true},
                    {data: 'section_name', name: 'section_name', searchable: true},
                    {data: 'kelas_name', name: 'kelas_name', searchable: true},
                    {data: 'status_generated_ended_contract', name: 'status_generated_ended_contract', searchable: true},
                ]
            });
        });

        var btn_generated_ended_contract = document.getElementById("btn_generated_ended_contract");
        btn_generated_ended_contract.addEventListener("click", function () {
            window.location = "worklist/" + id_division + "/generatedendedcontract";
        });

    });
</script>
@endsection
