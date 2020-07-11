@extends("app")
@section("content")
<!-- Page Content -->
<div class="page-wrapper">
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title m-b-0">Form</h3>
                    <p class="text-muted m-b-30 font-13"> Fill out the form correctly </p>
                    @if (isset($tour->id))
                    {{ Form::open(array('action' => array('TourController@update'), 'method' => 'POST' ,'class' => 'form-horizontal','enctype' => 'multipart/form-data', 'id' => 'my-awesome-dropzone')) }}
                    @else
                    {{ Form::open(array('action' => array('TourController@store'), 'method' => 'POST' ,'class' => 'form-horizontal','enctype' => 'multipart/form-data', 'id' => 'my-awesome-dropzone')) }}
                    @endif
                    <input type="hidden" name="id" value="{{ isset($tour->id) ? $tour->id : null }}">
                    <div class="form-group">
                        <label for="exampleInputuname" class="col-sm-3 control-label">Tour Name*</label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <input type="text" required="" class="form-control" placeholder="Tour Name" name="tour_name" value="{{ isset($tour->tour_name) ? $tour->tour_name : null }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputuname" class="col-sm-3 control-label">Tour Type*</label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <select class="form-control" require="" name="tour_type_id">
                                    <option>Select One</option>
                                    @foreach($type as $row)
                                    <option value="{{ $row->id }}">{{ $row->tour_type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputuname" class="col-sm-3 control-label">Country*</label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <select class="form-control" require="" name="country_id">
                                    <option>Select One</option>
                                    @foreach($country as $row)
                                    <option value="{{ $row->id }}">{{ $row->country_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputuname" class="col-sm-3 control-label">Tour Duration*</label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <input type="text" required="" class="form-control" placeholder="Duration" name="tour_duration" value="{{ isset($tour->tour_duration) ? $tour->tour_duration : null }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputuname" class="col-sm-3 control-label">Tour Price*</label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <input type="text" required="" class="form-control" placeholder="Price" name="tour_price" value="{{ isset($tour->tour_price) ? $tour->tour_price : null }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputuname" class="col-sm-3 control-label">Itinerary*</label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <textarea required="" class="form-control my-editor" name="tour_itinerary">{{ isset($tour->tour_itinerary) ? $tour->tour_itinerary : null }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputuname" class="col-sm-3 control-label">Description*</label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <textarea required="" class="form-control my-editor" name="tour_description">{!! isset($tour->tour_description) ? $tour->tour_description : null !!}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputuname" class="col-sm-3 control-label">Tour Photos*</label>
                        <div class="col-sm-6">
                            <div class="custom-file-container" data-upload-id="myUniqueUploadId">
                                <label>Upload File <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">&times;</a></label>
                                <label class="custom-file-container__custom-file">
                                    <input type="file" name="tour_photo[]" class="custom-file-container__custom-file__custom-file-input" accept="*" multiple aria-label="Choose File">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                </label>
                                <div class="custom-file-container__image-preview" id="sortable-container"></div>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <div class="checkbox checkbox-success">
                                <input id="hotdeals" type="checkbox" name="tour_hot_deals" value="1">
                                <label for="hotdeals">Hot Deals !</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group m-b-0">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-info waves-effect waves-light m-t-10">Save</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
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
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
    var editor_config = {
        path_absolute : "/",
        selector: "textarea.my-editor",
        plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
 
            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }
 
            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
        }
    };
 
    tinymce.init(editor_config);
</script>
@endsection