@extends('backend.layouts.base')
@section('title', 'Article Categories | Admin')

@section('content')

<div class="page-content">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-lg-9 col-xl-10  d-flex justify-content-lg-start justify-content-center">
							<div class="page-breadcrumb d-flex d-sm-flex align-items-center mb-2">
								<div class="breadcrumb-title pe-3">Article Categories</div>
								<div class="ps-3">
									<nav aria-label="breadcrumb">
										<ol class="breadcrumb mb-0 p-0">
											<li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
											</li>
											<li class="breadcrumb-item"><a href="/admin/articles">Articles</a></li>
											<li class="breadcrumb-item active" aria-current="page">Categories</li>
										</ol>
									</nav>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-xl-2 d-flex justify-content-lg-end justify-content-center">
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inputCategory"><i class='bx bxs-plus-square'></i>Add Category</button>
							<div class="modal fade" id="inputCategory" tabindex="-1" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Enter category</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<form action="{{ route('categories.store') }}" method="post">
											@csrf
											<div class="modal-body">
												<label for="name" class="col-form-label">Category</label>
												<input type="text" name="name" class="form-control" autofocus required></div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-primary">Submit</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-body p-4">
			@if (session('success'))
			<div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
				<div class="d-flex align-items-center">
					<div class="font-35 text-white"><i class='bx bxs-check-circle'></i></div>
					<div class="ms-3">
						<h6 class="mb-0 text-white">Success</h6>
						<div class="text-white">{{ session('success') }}</div>
					</div>
				</div>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			@endif
			@if (session('error'))
			<div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
				<div class="d-flex align-items-center">
					<div class="font-35 text-white"><i class='bx bxs-x-circle'></i></div>
					<div class="ms-3">
						<h6 class="mb-0 text-white">Failed!</h6>
						<div class="text-white">{{ session('error') }}</div>
					</div>
				</div>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			@endif
			@if ($errors->has('name'))
			<div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
				<div class="d-flex align-items-center">
					<div class="font-35 text-white"><i class='bx bxs-x-circle'></i></div>
					<div class="ms-3">
						<h6 class="mb-0 text-white">Failed</h6>
						<div class="text-white">{{ $errors->first('name') }}</div>
					</div>
				</div>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			@endif

			<div class="table-responsive">
				<table id="example" class="table mb-0 align-middle" style="width:100%">
					
					<thead class="table-light">
						
						<tr>
							
							<th>#</th>
							<th>Category</th>
							<th>Created at</th>
							<th>Total Article</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($category as $cat)
						<tr>
							
							<td>{{$loop->iteration}}</td>
							<td>{{ $cat->name }}</td>
							<td>{{ $cat->created_at->format('d M Y, h.iA') }}</td>
							<td>{{ $cat->article->count() }}</td>
							<td>
								<div class="dropdown ms-auto">
									<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">	<i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
									</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="{{ url('/articles/category/' . $cat->slug) }}" target="_blank">Open</a>
										</li>
										<li><button class="dropdown-item editCategory" data-bs-toggle="modal" data-bs-target="#editCategory" value="{{ $cat->id }}"">Edit</button>
										</li>
										<li>
											<form action="{{ route('categories.destroy', $cat->id) }}" method="post">
												@csrf
												@method('DELETE')
												<button type="submit" class="dropdown-item" id="delete">Delete</button> 
											</form>
										</li>
									</ul>
								</div>
							</td>
						</tr>
						<div class="modal fade" id="editCategory" tabindex="-1" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Edit category</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<form action="{{ route('categories.update', $cat->id) }}" method="post">
										@csrf
										@method('PUT')

										<input type="hidden" name="category_id" id="category_id">
										
										<div class="modal-body">
											<label for="name" class="col-form-label">Category</label>
											<input type="text" name="name" id="name" class="form-control" autofocus required></div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
											<button type="submit" id="submitCategory" class="btn btn-primary">Save</button>

										</div>
									</form>
								</div>
							</div>
						</div>
						@empty
						<tr>
							<td colspan="5" class="text-center">No category data available in table</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection