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
                        {{ Form::open(array('action' => array('WebdescController@store'), 'method' => 'POST' ,'class' => 'form-horizontal','enctype' => 'multipart/form-data')) }}
                        <input type="hidden" name="id" value="{{ isset($webdesc->id) ? $webdesc->id : null }}">
                            <div class="form-group">
                                <label for="exampleInputuname" class="col-sm-3 control-label">Web Title</label>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="webtitle" value="{{ isset($webdesc->webtitle) ? $webdesc->webtitle : null }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname" class="col-sm-3 control-label">Mkeyword</label>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <textarea class="form-control" name="mkeyword">{{ isset($webdesc->mkeyword) ? $webdesc->mkeyword : null }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname" class="col-sm-3 control-label">Mdescription</label>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <textarea class="form-control" name="mdescription">{{ isset($webdesc->mdescription) ? $webdesc->mdescription : null }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname" class="col-sm-3 control-label">URL</label>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="url" value="{{ isset($webdesc->url) ? $webdesc->url : null }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname" class="col-sm-3 control-label">Telp 1</label>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="telp1" value="{{ isset($webdesc->telp1) ? $webdesc->telp1 : null }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname" class="col-sm-3 control-label">Telp 2</label>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="telp2" value="{{ isset($webdesc->telp2) ? $webdesc->telp2 : null }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname" class="col-sm-3 control-label">Telp 3</label>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="telp3" value="{{ isset($webdesc->telp3) ? $webdesc->telp3 : null }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname" class="col-sm-3 control-label">Open Hours</label>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="ophour" value="{{ isset($webdesc->ophour) ? $webdesc->ophour : null }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" value="{{ isset($webdesc->email) ? $webdesc->email : null }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname" class="col-sm-3 control-label">Email From</label>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="emailfrom" value="{{ isset($webdesc->emailfrom) ? $webdesc->emailfrom : null }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname" class="col-sm-3 control-label">Nama From</label>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="namafrom" value="{{ isset($webdesc->namafrom) ? $webdesc->namafrom : null }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname" class="col-sm-3 control-label">Facebook</label>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="fb" value="{{ isset($webdesc->fb) ? $webdesc->fb : null }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname" class="col-sm-3 control-label">Twitter</label>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="twitter" value="{{ isset($webdesc->twitter) ? $webdesc->twitter : null }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname" class="col-sm-3 control-label">Google Plus</label>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="gplus" value="{{ isset($webdesc->gplus) ? $webdesc->gplus : null }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname" class="col-sm-3 control-label">Linkedin</label>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="linkedin" value="{{ isset($webdesc->linkedin) ? $webdesc->linkedin : null }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname" class="col-sm-3 control-label">Whatsapp</label>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="whatsapp" value="{{ isset($webdesc->whatsapp) ? $webdesc->whatsapp : null }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname" class="col-sm-3 control-label">Instagram</label>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="instagram" value="{{ isset($webdesc->instagram) ? $webdesc->instagram : null }}">
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