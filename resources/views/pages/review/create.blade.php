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
                    @if (isset($review->id))
                    {{ Form::open(array('action' => array('ReviewController@update'), 'method' => 'POST' ,'class' => 'form-horizontal','enctype' => 'multipart/form-data', 'id' => 'my-awesome-dropzone')) }}
                    @else
                    {{ Form::open(array('action' => array('ReviewController@store'), 'method' => 'POST' ,'class' => 'form-horizontal','enctype' => 'multipart/form-data', 'id' => 'my-awesome-dropzone')) }}
                    @endif
                    <input type="hidden" name="id" value="{{ isset($review->id) ? $review->id : null }}">
                    <div class="form-group">
                        <label for="exampleInputuname" class="col-sm-3 control-label">Review Name*</label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <input type="text" required="" class="form-control" placeholder="review Name" name="review_name" value="{{ isset($review->review_name) ? $review->review_name : null }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputuname" class="col-sm-3 control-label">Tour*</label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <select class="form-control" require="" name="tour_id">
                                    <option>Select One</option>
                                    @foreach($tour as $row)
                                    <option value="{{ $row->id }}" >{{ $row->tour_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputuname" class="col-sm-3 control-label">Review Value*</label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <textarea required="" class="form-control my-editor" name="review_value">{{ isset($review->review_value) ? $review->review_value : null }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputuname" class="col-sm-3 control-label">Review Description*</label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <textarea required="" class="form-control my-editor" name="review_value">{{ isset($review->review_description) ? $review->review_description : null }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputuname" class="col-sm-3 control-label">Review Date*</label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <input type="datetime-local" required="" class="form-control" placeholder="review Name" name="review_name" value="{{ isset($review->review_name) ? $review->review_name : null }}">
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

@endsection