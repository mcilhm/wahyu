@if (Session::has('success.message'))
    <script>
        swal({   title: "Success"  , text: "{{ Session::get('success.message') }}", type: "success",  html: true });
    </script>
    @elseif (Session::has('error.message'))
    <script>
        swal({   title: "Failed", text: "{{ Session::get('error.message') }}", type: "error",  html: true });
    </script>
@endif
<script>

    $('body').on('click', '.sa-remove', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var postId = $(this).data('id'); 
        swal({
            title: "are u sure?",
            text: "lorem lorem lorem",
            type: "error",
            html: true,
            showCancelButton: true,
            confirmButtonClass: 'btn-danger waves-effect waves-light',
            confirmButtonText: "Delete",
            cancelButtonText: "Cancel",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(){
            window.location.href = url;
        });
    });
</script>