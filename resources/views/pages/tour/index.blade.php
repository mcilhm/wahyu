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
                            <a href="{{ url('tour/create') }}"><button class="btn btn-block btn-primary">Add</button></a>
                        </div>
                        <p class="text-muted m-b-30">Export data to Copy, CSV, Excel, PDF & Print</p>
                        <div class="table-responsive">
                            <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Tour ID</th>
                                        <th>Tour Name</th>
                                        <th>Tour Type</th>
                                        <th>Tour Country</th>
                                        <th>Tour Duration</th>
                                        <th>Tour Price</th>
                                        <th>Hidden</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Tour ID</th>
                                        <th>Tour Name</th>
                                        <th>Tour Type</th>
                                        <th>Tour Country</th>
                                        <th>Tour Duration</th>
                                        <th>Tour Price</th>
                                        <th>Hidden</th>
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
                    "url": "tour/tourlist"
                },
                columns: [
                    {data: 'tour_id', name: 'id', orderable: false, searchable: true, className: "text-center "},
                    {data: 'tour_name', name: 'tour_name', searchable: true},
                    {data: 'tour_type', name: 'tour_type', searchable: true},
                    {data: 'tour_country', name: 'tour_country', searchable: true},
                    {data: 'tour_duration', name: 'tour_duration'},
                    {data: 'tour_price', name: 'tour_price'},
                    {data: 'is_hidden', name: 'is_hidden'},
                    {data: 'action', name: 'action', orderable: false}
                ]
            });

    });
</script>
@endsection