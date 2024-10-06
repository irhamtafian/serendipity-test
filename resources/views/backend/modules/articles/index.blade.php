@extends('backend.layouts.base')
@section('title', 'Articles | Admin')

@section('content')

<div class="page-content">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-lg-9 col-xl-10  d-flex justify-content-lg-start justify-content-center">
							<div class="page-breadcrumb d-flex d-sm-flex align-items-center mb-2">
								<div class="breadcrumb-title pe-3">Articles</div>
								<div class="ps-3">
									<nav aria-label="breadcrumb">
										<ol class="breadcrumb mb-0 p-0">
											<li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
											</li>
											<li class="breadcrumb-item active" aria-current="page">Articles</li>
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
			@if (session('success'))
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
			@if (session('draft'))
			<div class="alert alert-warning border-0 bg-warning alert-dismissible fade show py-2">
				<div class="d-flex align-items-center">
					<div class="font-35 text-white"><i class='bx bxs-check-circle'></i>
					</div>
					<div class="ms-3">
						<h6 class="mb-0 text-white">Draft</h6>
						<div class="text-white">{{ session('draft') }}</div>
					</div>
				</div>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			@endif
			@if (session('info'))
			<div class="alert alert-info border-0 bg-info alert-dismissible fade show py-2">
				<div class="d-flex align-items-center">
					<div class="font-35 text-dark"><i class='bx bxs-info-circle'></i>
					</div>
					<div class="ms-3">
						<h6 class="mb-0 text-dark">Info</h6>
						<div class="text-dark">{{ session('info') }}</div>
					</div>
				</div>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			@endif
			@if (session('error'))
			<div class="alert alert-error border-0 bg-success alert-dismissible fade show py-2">
				<div class="d-flex align-items-center">
					<div class="font-35 text-white"><i class='bx bxs-check-circle'></i>
					</div>
					<div class="ms-3">
						<h6 class="mb-0 text-white">Error</h6>
						<div class="text-white">{{ session('error') }}</div>
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
							<th>Title</th>
							<th>Category</th>
							<th>Created at</th>
							<th>Thumbnail</th>
							<th>Status</th>
							<th>Views</th>
							<th>Comments</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($articles as $row)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>
								@if(strlen($row->title) > 50)
									{{ substr($row->title, 0, 50) }}...
								@else
									{{ $row->title }}
								@endif
							</td>
							
							<td>{{ $row->category->name }}</td>
							<td>{{ $row->created_at->format('d M Y, h.iA') }}</td>
							<td>
								<div class="recent-product-img">
									<img src="{{ asset('storage/'.$row->header_articles) }}" alt="{{ $row->title }}">
								</div>				
							</td>
							{{-- <td>
								<div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
									Publish
								</div>
							</td> --}}
							<td>{!! $row->status_label !!}</td>
							<td>{{$row->views}}</td>
							<td>{{$row->publish_comments->count()}}</td>
							<td>
								<div class="dropdown ms-auto">
									<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">	<i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
									</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="{{ url('/articles/' . $row->slug) }}" target="_blank">Open</a>
										</li>
										<li><a class="dropdown-item" href="{{ route('articles.edit', $row->id) }}">Edit</a>
										</li>
										<li>
											<form action="{{ route('articles.destroy', $row->id) }}" method="post">
												@csrf
												@method('DELETE')
												<button type="submit" class="dropdown-item" id="delete">Delete</button> 
											</form>
										</li>
									</ul>
								</div>
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="9" class="text-center">No article data available in table</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection