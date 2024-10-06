<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<!--plugins-->
	<link href="{{ asset('assets/backend/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/backend/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/backend/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset('assets/backend/css/pace.min.css') }}" rel="stylesheet" />
	<script src="{{ asset('assets/backend/js/pace.min.js') }}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('assets/backend/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/backend/css/bootstrap-extended.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ asset('assets/backend/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/backend/css/icons.css') }}" rel="stylesheet">
	<title>Login - Admin</title>
</head>

<body class="">
	<!--wrapper-->
	<div class="wrapper">
		<div class="d-flex align-items-center justify-content-center my-5">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<div class="card mb-0">
							<div class="card-body">
								<div class="p-4">
									<div class="mb-3 text-center">

									</div>
									<div class="text-center mb-4">
										<h5 class="">Login</h5>
										<p class="mb-0">Please log in to your account</p>
									</div>
							
									@if (session()->has('success'))
									<div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
										<div class="d-flex align-items-center">
											<div class="font-35 text-white"><i class='bx bxs-check-circle'></i>
											</div>
											<div class="ms-3">
												<h6 class="mb-0 text-white">Success</h6>
												<div class="text-white">{{ session('success') }}</div>
											</div>
										</div>
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</div>
									@endif

									@if (session()->has('loginError'))
									<div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
										<div class="d-flex align-items-center">
											<div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
											</div>
											<div class="ms-3">
												<h6 class="mb-0 text-white">Login Failed</h6>
												<div class="text-white">{{ session('loginError') }}</div>
											</div>
										</div>
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</div>
									@endif

									@if (session()->has('logoutSuccess'))
									<div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
										<div class="d-flex align-items-center">
											<div class="font-35 text-white"><i class='bx bxs-check-circle'></i>
											</div>
											<div class="ms-3">
												<h6 class="mb-0 text-white">Success</h6>
												<div class="text-white">{{ session('logoutSuccess') }}</div>
											</div>
										</div>
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</div>
									@endif

									<div class="form-body">
										<form class="row g-3 action="login" method="post"">
											@csrf
											<div class="col-12">
												<label for="email" class="form-label">Email Address</label>
												<input type="email"  class="form-control" placeholder="Enter Email Address" name="email"id="email" value="{{ old('email') }}" autofocus required>
											</div>
											<div class="col-12">
												<label for="inputChoosePassword" class="form-label">Password</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" class="form-control border-end-0" placeholder="Enter Password" name="password" id="password" required> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
											</div>
											
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-primary">Login</button>
												</div>
											</div>
											<div class="col-12">
												<div class="text-center ">
													<p class="mb-0">Don't have an account yet? <a href="/admin/register">Register in here</a></p>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				 </div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="{{ asset('assets/backend/js/bootstrap.bundle.min.js') }}"></script>
	<!--plugins-->
	<script src="{{ asset('assets/backend/js/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/backend/plugins/simplebar/js/simplebar.min.js') }}"></script>
	<script src="{{ asset('assets/backend/plugins/metismenu/js/metisMenu.min.js') }}"></script>
	<script src="{{ asset('assets/backend/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<!--app JS-->
	<script src="{{ asset('assets/backend/js/app.js') }}"></script>
</body>

</html>