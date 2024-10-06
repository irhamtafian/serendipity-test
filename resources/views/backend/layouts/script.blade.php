<script src="{{ asset('assets/backend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/Drag-And-Drop/dist/imageuploadify.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/fancy-file-uploader/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/fancy-file-uploader/jquery.fileupload.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/fancy-file-uploader/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/fancy-file-uploader/jquery.fancy-fileupload.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/notifications/js/lobibox.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/notifications/js/notifications.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/notifications/js/notification-custom-script.js') }}"></script>
<script src="{{ asset('assets/backend/js/app.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
      } );
</script>

<script>
    $(document).ready(function() {
        var table = $('#example2').DataTable( {
            lengthChange: false,
            buttons: [ 'copy', 'excel', 'pdf', 'print']
        } );
     
        table.buttons().container()
            .appendTo( '#example2_wrapper .col-md-6:eq(0)' );
    } );
</script>

<script>
    $(document).ready(function () {
        $('#image-uploadify').imageuploadify();
    })
</script>

<script>
    $('#fancy-file-upload').FancyFileUpload({
        params: {
            action: 'fileuploader'
        },
        maxfilesize: 1000000
    });
</script>

<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<script src="{{ asset('assets/js/pages/sweetalert.init.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $(document).on('click', '.editCategory', function () {
            var category_id = $(this).val();
            $('#editCategory').modal('show');

            $.ajax({
            type: "GET",
            url: "/admin/articles/categories/" + category_id + "/edit",
            success: function (response) {
                if (response && response.category) {
                    var categoryName = response.category.name;
                    $('#name').val(categoryName);
                    $('#category_id').val(category_id);
                    $('#editCategory').modal('show');
                } else {
                    console.error('Invalid response or category data missing.');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error fetching category data:', error);
            }
        });

        });
        
    });
</script>

<script type="text/javascript">
    $(function(){
        $(document).on('click', '#publish', function(e){
            e.preventDefault();
            var form = $(this).closest('form');  
            var link = form.attr("action");  

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#6e7881',
                confirmButtonText: 'Yes, publish it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();  
                }
                });
        });
    });
</script>

<script type="text/javascript">
    $(function(){
        $(document).on('click', '#delete', function(e){
            e.preventDefault();
            var form = $(this).closest('form');  
            var link = form.attr("action");  

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();  
                }
                });
        });
    });
</script>

<script type="text/javascript">
    $(function(){
        $(document).on('click', '#delete', function(e){
            e.preventDefault();
            var form = $(this).closest('form');  

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();  
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        @if (session('notFound'))
            round_warning_noti();
        @endif
    });

    function round_warning_noti() {
        Lobibox.notify('warning', {
            pauseDelayOnHover: true,
            size: 'mini',
            rounded: true,
            delayIndicator: false,
            icon: 'bx bx-error',
            continueDelayOnInactiveTab: false,
            position: 'top right',
            msg: '{{ session('notFound') }}'
        });
    }
</script>
