<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<!--plugins-->
	<link rel="stylesheet" href="{{ asset('assets/backend/plugins/notifications/css/lobibox.min.css') }}" />
	<link href="{{ asset('assets/backend/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/backend/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/backend/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/backend/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/backend/plugins/Drag-And-Drop/dist/imageuploadify.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/backend/plugins/fancy-file-uploader/fancy_fileupload.css') }}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset('assets/backend/css/pace.min.css') }}" rel="stylesheet" />
	<script src="{{ asset('assets/backend/js/pace.min.js') }}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('assets/backend/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/backend/css/bootstrap-extended.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ asset('assets/backend/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/backend/css/icons.css') }}" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{ asset('assets/backend/css/dark-theme.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/backend/css/semi-dark.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/backend/css/header-colors.css') }}" />
	<title>
        @yield('title')
    </title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		@include("backend.layouts.navigation")
		<!--end sidebar wrapper -->

		<!--start header -->
		<header>
			@include("backend.layouts.header")           
		</header>
		<!--end header -->
		
		<!--start page wrapper -->
		<div class="page-wrapper">
			<!-- Content -->
            @yield('content')
		</div>
		<!--end page wrapper -->

		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->

		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>

		<!--End Back To Top Button-->
		<footer class="page-footer">
			@include("backend.layouts.footer")
		</footer>
        
	</div>
	<!--end wrapper-->

    <!--Script-->
	@include("backend.layouts.script")
</body>

</html>