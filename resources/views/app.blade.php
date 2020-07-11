<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('plugins/images/favicon.png') }}">
    <title>Skyriept Travel</title>
    <!-- ===== Bootstrap CSS ===== -->
    <link href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- ===== Plugin CSS ===== -->
    <link href="{{ asset('plugins/components/chartist-js/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/components/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- ===== Animation CSS ===== -->
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <!-- ===== Custom CSS ===== -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- ===== Color CSS ===== -->
    <link href="{{ asset('css/colors/default.css') }}" id="theme" rel="stylesheet">
    <!-- ===== Sweetalert CSS ===== -->
    <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
    <!-- ===== filepond CSS ===== -->
    <!-- <link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet"> -->
    <!-- <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css" rel="stylesheet"> -->


    <link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview@4.0.2/dist/file-upload-with-preview.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="mini-sidebar">
    <!-- ===== Main-Wrapper ===== -->
    <div id="wrapper">
        <div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div>

        <!-- Start header -->
        @include("_particles.header")
        <!-- End header -->


        <!-- Start leftbar -->
        @include("_particles.leftbar")
        <!-- End leftbar -->

        <!-- ===== Page-Content ===== -->
        @yield("content")
        <!-- ===== Page-Content-End ===== -->


    </div>
    <!-- ===== Main-Wrapper-End ===== -->
    <!-- ==============================
        Required JS Files
    =============================== -->
    <!-- ===== jQuery ===== -->
    <script src="{{ asset('plugins/components/jquery/dist/jquery.min.js') }}"></script>
    <!-- ===== Bootstrap JavaScript ===== -->
    <script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- ===== Slimscroll JavaScript ===== -->
    <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
    <!-- ===== Wave Effects JavaScript ===== -->
    <script src="{{ asset('js/waves.js') }}"></script>
    <!-- ===== Menu Plugin JavaScript ===== -->
    <script src="{{ asset('js/sidebarmenu.js') }}"></script>
    <!-- ===== Custom JavaScript ===== -->
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/jasny-bootstrap.js') }}"></script>
    <!-- ===== Plugin JS ===== -->
    <script src="{{ asset('plugins/components/chartist-js/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('plugins/components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('plugins/components/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('plugins/components/sparkline/jquery.charts-sparkline.js') }}"></script>
    <script src="{{ asset('plugins/components/knob/jquery.knob.js') }}"></script>
    <script src="{{ asset('plugins/components/easypiechart/dist/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('js/db1.js') }}"></script>
    <!-- ===== Style Switcher JS ===== -->
    <script src="{{ asset('plugins/components/styleswitcher/jQuery.style.switcher.js') }}"></script>


    <script src="{{ asset('plugins/components/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

    <script src="https://unpkg.com/file-upload-with-preview@4.0.2/dist/file-upload-with-preview.min.js"></script>

    <!-- Polyfills needed for ie11 support -->
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fetch/2.0.3/fetch.js"></script>

    <script>
        var upload = new FileUploadWithPreview('myUniqueUploadId', {
            showDeleteButtonOnImages: true,
            text: {
                chooseFile: 'Select Image',
                browse: 'Browse',
                selectedCount: 'Selected',
            },

            @if(isset($tour->tour_name))
            presetFiles: [
                @foreach($tour_photos as $key)
                '{{ asset($key->tour_photo) }}',
                @endforeach
            ]
            @endif

        })


        $("#sortable-container").sortable({
            update: function(event, ui) {
                // Get the new token order
                let newTokenOrder = $(this).sortable('toArray', {
                    attribute: 'data-upload-token'
                })

                // Init new array that we'll file with the correct order
                let sortedCachedFileArray = []

                // Loop through the newTokenOrder array and add each email in place as found
                for (let x = 0; x < newTokenOrder.length; x++) {
                    let foundIndex = upload.cachedFileArray.map(image => image.token).indexOf(newTokenOrder[x])
                    sortedCachedFileArray.push(upload.cachedFileArray[foundIndex])
                }

                // Replace the cachedFileArray with your new sortedCachedFileArray
                upload.replaceFiles(sortedCachedFileArray)
            }
        });
    </script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    @yield('footer')
    @include('.errors.swalerror')
</body>

</html>