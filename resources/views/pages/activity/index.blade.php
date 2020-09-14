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
                        <p class="text-muted m-b-30">Export data to Copy, CSV, Excel, PDF & Print</p>
                        <div class="table-responsive">
                            <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Activity Before Day</th>
                                        <th>Slug</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Activity Before Day</th>
                                        <th>Slug</th>
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
                        {{ Form::open(array('action' => array('Admin\ActivityController@store'), 'method' => 'POST' ,'class' => 'form-horizontal','enctype' => 'multipart/form-data')) }}
                            <input type="hidden" name="id" value="{{ isset($activity->id) ? $activity->id : null }}">
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <input type="text" required="" class="form-control" placeholder="Name" name="activity_name" value="{{ isset($activity->activity_name) ? $activity->activity_name : null }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <input type="text" required="" class="form-control" placeholder="Description" name="activity_description" value="{{ isset($activity->activity_description) ? $activity->activity_description : null }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Before Day</label>
                                <input type="text" required="" class="form-control" placeholder="Before Day" name="activity_before_day" value="{{ isset($activity->activity_before_day) ? $activity->activity_before_day : null }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Slug</label>
                                <input type="text" required="" class="form-control" placeholder="Slug" name="activity_slug" value="{{ isset($activity->activity_slug) ? $activity->activity_slug : null }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info waves-effect waves-light m-t-10">Proses</button>
                                <a href="{{ url('activity') }}" class="btn btn-danger waves-effect waves-light m-t-10">Cancel</a>
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
                    "url": "activity/activitylist"
                },
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: true, className: "text-center "},
                    {data: 'activity_name', name: 'activity_name', searchable: true},
                    {data: 'activity_description', name: 'activity_description', searchable: true},
                    {data: 'activity_before_day', name: 'activity_before_day', searchable: true},
                    {data: 'activity_slug', name: 'activity_slug', searchable: true},
                    {data: 'action', name: 'action', orderable: false}
                ]
            });

    });
</script>
@endsection
