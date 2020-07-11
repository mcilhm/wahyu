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
                                        <th>Slider Photo</th>
                                        <th>Slider Name</th>
                                        <th>Slider URL</th>
                                        <th>Position</th>
                                        <th>Slider Show</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Slider Photo</th>
                                        <th>Slider Name</th>
                                        <th>Slider URL</th>
                                        <th>Position</th>  
                                        <th>Slider Show</th>
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
                        {{ Form::open(array('action' => array('SliderController@store'), 'method' => 'POST' ,'class' => 'form-horizontal','enctype' => 'multipart/form-data')) }}
                            <input type="hidden" name="id" value="{{ isset($slider->id) ? $slider->id : null }}">
                            <div class="form-group">
                                <label class="control-label">Slider Name</label>
                                <input type="text" required="" class="form-control" placeholder="Slider Name" name="slider_name" value="{{ isset($slider->slider_name) ? $slider->slider_name : null }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Slider Photo</label>
                                <input type="file" class="form-control" name="slider_photo">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Slider Url</label>
                                <textarea required="" class="form-control" name="slider_url">{{ isset($slider->slider_url) ? $slider->slider_url : null }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Slider Position</label>
                                <input type="text" required="" class="form-control" placeholder="Slider Position" name="position" value="{{ isset($slider->position) ? $slider->position : null }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info waves-effect waves-light m-t-10">Proses</button>
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
                    "url": "slider/sliderlist"
                },
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: true, className: "text-center "},
                    {data: 'slider_photo', name: 'slider_photo', searchable: true},
                    {data: 'slider_name', name: 'slider_name', searchable: true},
                    {data: 'slider_url', name: 'slider_url', searchable: true},
                    {data: 'position', name: 'position', searchable: true},
                    {data: 'slider_show', name: 'slider_show', searchable: true},
                    {data: 'action', name: 'action', orderable: false}
                ]
            });

    });
</script>
@endsection