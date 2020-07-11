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
                        {{ Form::open(array('action' => array('ContentController@store'), 'method' => 'POST' ,'class' => 'form-horizontal','enctype' => 'multipart/form-data')) }}
                        <input type="hidden" name="id" value="{{ isset($content->id) ? $content->id : null }}">
                            <div class="form-group">
                                <label for="exampleInputuname" class="col-sm-3 control-label">Content Name*</label>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <input type="text" required="" class="form-control" placeholder="Content Name" name="content_name" value="{{ isset($content->content_name) ? $content->content_name : null }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname" class="col-sm-3 control-label">Content Value*</label>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <textarea required="" class="form-control my-editor" name="content_value">{{ isset($content->content_value) ? $content->content_value : null }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname" class="col-sm-3 control-label">Content Slug*</label>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <input type="text" required="" class="form-control" placeholder="Slug" name="content_slug" value="{{ isset($content->content_slug) ? $content->content_slug : null }}">
                                    </div>
                                </div>
                            </div>
    
                            <div class="form-group m-b-0">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-info waves-effect waves-light m-t-10">Proses</button>
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