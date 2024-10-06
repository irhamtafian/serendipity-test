@extends('backend.layouts.base')
@section('title', 'Blank Page')

@section('content')

<div class="page-content">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-lg-9 col-xl-10  d-flex justify-content-lg-start justify-content-center">
							<div class="page-breadcrumb d-flex d-sm-flex align-items-center mb-2">
								<div class="breadcrumb-title pe-3">Blank</div>
								<div class="ps-3">
									<nav aria-label="breadcrumb">
										<ol class="breadcrumb mb-0 p-0">
											<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
											</li>
											<li class="breadcrumb-item active" aria-current="page">Blank</li>
										</ol>
									</nav>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-xl-2 d-flex justify-content-lg-end justify-content-center">
							<a href="articles/create" class="btn btn-primary mb-3 mb-lg-0"><i class='bx bxs-plus-square'></i>Add Article</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-body p-4">
			@if(request()->has('angka1')&&request()->has('angka2'))
			@php

			$angka1 = request('angka1');
			$angka2 = request('angka2');

			$hasil = $angka1 + $angka2;
			@endphp
			Hasil:{{ $hasil }}
			@endif

			<form method="GET" action="">
				<input type="number" id="angka1" name="angka1" >
				<input type="number" id="angka2" name="angka2" >

				<button type="submit"> Tambah </button>

			</form>
		
			
		</div>
	</div>

</div>

@endsection